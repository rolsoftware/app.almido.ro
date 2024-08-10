<?php

namespace App\Http\Requests\Base;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'username'          => ['required', 'alpha_dash', 'max:32', Rule::unique('users')->ignore($this->user)],
            'email'             => ['required', 'email',  'max:250', Rule::unique('users')->ignore($this->user)],
            'name'              => ['required', 'string', 'max:250'],
            'roles'             => ['required', 'array'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
