<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticateTestingEnv extends FormRequest
{
    final public function rules(): array
    {
        return [
            'username' => 'required|in:testing',
            'password' => 'required|in:testing',
        ];
    }

    final public function authorize(): bool
    {
        return true;
    }
}