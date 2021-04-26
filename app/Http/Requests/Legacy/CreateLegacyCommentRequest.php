<?php

namespace App\Http\Requests\Legacy;

use Illuminate\Foundation\Http\FormRequest;

class CreateLegacyCommentRequest extends FormRequest
{
    final public function rules(): array
    {
        return [
            'comment' => 'required|string|max:255',
        ];
    }
}
