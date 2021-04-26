<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\role;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->title = ucwords(str_replace('-', ' ', request()->segment(2)));
    }

    public function index()
    {
        $content['title'] = $this->title;
        if (request()->ajax()) {
            return datatables()->of(User::latest()->where('role_id', '<>', 2)->get())
                ->addColumn('image', function ($data) {
                    return '<img width="65" src="' . asset(!empty($data->profile_picture) ? $data->profile_picture : 'assets/admin/images/placeholder.png') . '">';
                })->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" class="delete_checkbox" value="' . $data->id . '">';
                })->addColumn('action', function ($data) {
                    return '<a data-col="1" title="Edit" href="user/edit/' . $data->id . '" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;<button data-col="2" data-row="' . $data->id . '" title="View" type="button" name="view" id="' . $data->id . '" class="views btn btn-info btn-sm"><i class="fa fa-eye"></i></button>&nbsp;<button data-col="3" data-row="' . $data->id . '" title="Delete" type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>';
                })->rawColumns(['checkbox', 'action', 'image'])->make(true);
        }
        return view('admin.' . request()->segment(2) . '.list')->with($content);
    }

    public function register()
    {
        $content['title'] = $this->title;
        $role = new role;
        $content['role'] = $role->getRole();
        return view('admin.users.form')->with($content);
    }

    public function edit($id)
    {
        if (auth()->user()->id != $id) {
            return redirect()->route('user.edit', auth()->user()->id);
        }
        $content['title'] = $this->title;
        $content['record'] = User::findOrFail($id);
        $role = new role;
        $content['role'] = $role->getRole();

        if ($content['record']->is_legacy) {
            $content['legacy'] = $content['record']->load([
                'legacy' => static function (HasOne $legacy) {
                    $legacy->with('publicComments', 'privateComments.user:id,first_name,last_name', 'legacyTimeline');
                },
            ])->legacy;
        }

        return view('admin.users.edit')->with($content);
    }

    public function update(Request $request, $id)
    {

        $this->validator($request->all(), $id)->validate();

        event(new Registered($this->updated($request->all(), $id)));

        return redirect()->back()->with('success', 'Updated Successfully');
    }

    protected function validator(array $data, int $id)
    {
        $validations = $data["role_id"] !== 5 ? [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['confirmed'],
            'contact_number' => ['required', 'string'],
            'role_id' => ['required', 'numeric'],
        ] : [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['confirmed'],
            'contact_number' => ['required', 'string'],
            'role_id' => ['required', 'numeric'],
            'company_name' => ['required'],
            'company_description' => ['required'],
            'website' => ['required']
        ];

        if (User::findOrFail($id)->is_legacy) {
            $validations = array_merge($validations, [
                'legacy_cemetery_location' => 'required|string|max:255',
                'legacy_description' => 'required|string|max:65535',
                'legacy_from' => 'required|integer|min:1900|max:' . date('Y'),
                'legacy_to' => 'required|integer|min:1901|max:' . date('Y'),
//                'legacy_timeline' => 'required|array',
//                'legacy_timeline.*.year' => 'required|integer|min:1900|max:' . date('Y'),
//                'legacy_timeline.*.heading' => 'required|string|max:255',
//                'legacy_timeline.*.description' => 'required|string|max:65535',
            ]);
        }

        return Validator::make($data, $validations);
    }

    protected function updated(array $data, $id)
    {
        $request = request();
        $profile_picture = '';
        if (!empty($request->file('profile_picture'))) {
            $profile_picture = $request->file('profile_picture');
            $image = rand() . '.' . $profile_picture->getClientOriginalExtension();
            $profile_picture->move(public_path('assets/admin/images'), $image);
            $profile_picture = 'assets/admin/images/' . $image;
        }

        $cover_image = '';
        if (!empty($request->file('cover_image'))) {
            $cover_image = $request->file('cover_image');
            $image = rand() . '.' . $cover_image->getClientOriginalExtension();
            $cover_image->move(public_path('assets/admin/images'), $image);
            $cover_image = 'assets/admin/images/' . $image;
        }

        $name = explode(' ', $data["name"]);
        $f_name = $name[0];
        $l_name = '';
        for ($n = 1; $n < count($name); $n++) {
            $l_name .= $name[$n] . " ";
        }
        $l_name = trim($l_name);

        $profile_check = $data["check"];
        $profiles = [];
        $profiles["website"] = [0, $data["website"] ?? ""];
        $profiles['https'] = [0, $data['https'] ?? ""];
        $profiles["linkdin"] = [0, $data["linkdin"] ?? ""];
        $profiles["facebook"] = [0, $data["facebook"] ?? ""];
        $profiles["instagram"] = [0, $data["instagram"] ?? ""];
        $profiles["tiktok"] = [0, $data["tiktok"] ?? ""];
        $profiles["google_review"] = [0, $data['google_review'] ?? ""];

        if ($profile_check == "website") {
            $profiles["website"] = [1, $data["website"]];
        } else if ($profile_check == "linkdin") {
            $profiles["linkdin"] = [1, $data["linkdin"]];
        } else if ($profile_check == "facebook") {
            $profiles["facebook"] = [1, $data["facebook"]];
        } else if ($profile_check == "instagram") {
            $profiles["instagram"] = [1, $data["instagram"]];
        } else if ($profile_check == "tiktok") {
            $profiles["tiktok"] = [1, $data["tiktok"]];
        } else if ($profile_check == "google_review") {
            $profiles["google_review"] = [1, $data["google_review"]];
        }

        /* @var User $userToUpdate */
        $userToUpdate = User::findOrFail($id);

        if ((int)$data["role_id"] !== 5 && (int)$data["role_id"] !== 7) {

            $userToUpdate->update([
                'first_name' => $f_name, 'last_name' => $l_name, 'email' => $data['email'], 'contact_number' => $data['contact_number'], 'occupation' => $data['occupation'],
                'job_title' => $data['occupation'], 'role_id' => $data['role_id'], 'profile_picture' => !empty($profile_picture) ? $profile_picture : $userToUpdate->profile_picture,
            ]);
        } else {

            $userToUpdate->update([
                'first_name' => $f_name,
                'last_name' => $l_name,
                'email' => $data['email'],
                'contact_number' => $data['contact_number'],
                'mobile_number' => $data['mobile_number'],
                'mobile_check' => $data['mobile_check'],
                'occupation' => $data['occupation'],
                'job_title' => $data['occupation'],
                'role_id' => $data['role_id'],
                'profile_picture' => !empty($profile_picture) ? $profile_picture : $userToUpdate->profile_picture,
                'cover_image' => !empty($cover_image) ? $cover_image : $userToUpdate->cover_image,
                'company_name' => $data["company_name"],
                'company_description' => $data["company_description"],
                'address' => $data["address"] ?? "",
                'state' => $data["state"] ?? "",
                'city' => $data["city"] ?? "",
                'province' => $data["province"] ?? "",
                'zipcode' => $data["zipcode"] ?? "",
                'website' => $data["website"],
                'https' => $data['https'] ?? "",
                'website_check' => $profiles["website"][0],
                'linkedin_check' => $profiles["linkdin"][0],
                'linkedin' => $this->check_https($profiles["linkdin"][1]),
                'facebook_check' => $profiles["facebook"][0],
                'facebook' => $this->check_https($profiles["facebook"][1]),
                'instagram_check' => $profiles["instagram"][0],
                'instagram' => $this->check_https($profiles["instagram"][1]),
                'tiktok_check' => $profiles["tiktok"][0],
                'tiktok' => $this->check_https($profiles["tiktok"][1]),

                'google_review_check' => $profiles["google_review"][0],
                'google_review' => $this->check_https($profiles["google_review"][1]),
            ]);
        }

        if (trim($data['password']) !== '') {
            $userToUpdate->update([
                'password' => Hash::make($data['password'])
            ]);
        }

        $cash_app = isset($data['cash_app']) && !empty($data['cash_app']) ? $data['cash_app'] : NULL;
        $website_address = isset($data['website_address']) && !empty($data['website_address']) ? $data['website_address'] : NULL;
        $appointment_booking = isset($data['appointment_booking']) && !empty($data['appointment_booking']) ? $data['appointment_booking'] : NULL;

        $userToUpdate->update(compact('cash_app', 'appointment_booking', 'website_address'));

        if ($userToUpdate->is_legacy) {

            $userToUpdate->legacy()->update([
                'cemetery_location' => $data['legacy_cemetery_location'],
                'from' => $data['legacy_from'],
                'to' => $data['legacy_to']
            ]);

            $timelinePartIdsNotToDelete = [];

            foreach ($data['legacy_timeline'] as $timeLineToUpdate) {

                if (array_key_exists('id', $timeLineToUpdate)) {

                    $userToUpdate->legacy->legacyTimeline()->where('legacy_timeline.id', '=', $timeLineToUpdate['id'])->update([
                        'year' => $timeLineToUpdate['year'],
                        'heading' => $timeLineToUpdate['heading'],
                        'description' => $timeLineToUpdate['description'],
                    ]);

                    $timelinePartIdsNotToDelete[] = $timeLineToUpdate['id'];
                } else {

                    $createdTimeLinePart = $userToUpdate->legacy->legacyTimeline()->create([
                        'year' => $timeLineToUpdate['year'],
                        'heading' => $timeLineToUpdate['heading'],
                        'description' => $timeLineToUpdate['description'],
                    ]);

                    $timelinePartIdsNotToDelete[] = $createdTimeLinePart->id;
                }
            }

            $userToUpdate->legacy->legacyTimeline()->whereNotIn('id', $timelinePartIdsNotToDelete)->delete();
        }

        return auth()->user();
    }

    public function check_https($url)
    {
        $check_https = explode(':', $url)[0];
        if (strlen($url) > 3 && $check_https != 'https') {
            return 'https://' . $url;
        }
        return $url;
    }

    public function delete_all(Request $request)
    {
        dd($request->input('checkboxValue'));
    }

}
