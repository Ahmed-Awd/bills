<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email'        => 'required|email|min:6|max:150',
            'password'     => 'required|string|min:6|max:50',
        ];
    }

}
