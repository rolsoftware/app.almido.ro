<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'type'          => ['required', 'integer', 'gt:0'],
            'key'           => ['required', 'string', 'max:100',Rule::unique('vars')->ignore($this->var)],
            'value'         => ['required', 'string', 'max:255'],
            'description'   => ['required', 'string', 'max:255'],
            'is_public'     => ['nullable', 'boolean'],
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
