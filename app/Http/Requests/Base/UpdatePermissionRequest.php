<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => ['required', 'regex:/^[a-zA-Z0-9-_:]*$/', 'max:64', 'unique:permissions,name,'.$this->permission->id],
            'guard_name'    => ['required', 'string', 'max:64'],
        ];;
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
