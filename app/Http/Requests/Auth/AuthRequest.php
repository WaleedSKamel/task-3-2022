<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function onLogin(): array
    {
        return [
            'email' => ['required', 'email', 'min:2', 'max:255', 'string', Rule::exists('users', 'email')],
            'password' => ['required', 'string', 'min:2', 'max:255'],
        ];
    }

    public function onRegister(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'string', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:2', 'max:255', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:2', 'max:255', 'same:password'],
        ];
    }

    public function rules(): array
    {
        if (request()->routeIs('post.login')) {
            return $this->onLogin();
        } elseif (request()->routeIs('post.register')) {
            return $this->onRegister();
        } else {
            return [];
        }
    }
}
