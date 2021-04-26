<?php

namespace App\Http\Requests\Legacy;

use Illuminate\Foundation\Http\FormRequest;

class ChangeLegacyDescriptionRequest extends FormRequest
{
    final public function rules(): array
    {
        return [
            'description' => 'required|string|max:65535'
        ];
    }
}
