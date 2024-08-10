<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {

        return [
            'username'          => ['required', 'alpha_dash', 'max:32', 'unique:users,username'],
            'email'             => ['required', 'email',  'max:250', 'unique:users,email'],
            'name'              => ['required', 'string', 'max:250'],
            'password'          => ['required', 'string', 'min:6', 'max:32','same:confirm_password'],
            'confirm_password'  => ['required', 'string', 'min:6', 'max:32'],
            'roles'             => ['required', 'array'],
        ];
    }
}
