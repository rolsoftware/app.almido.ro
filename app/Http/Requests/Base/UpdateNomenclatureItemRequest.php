<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNomenclatureItemRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomenclature_id'   => ['required', 'numeric', 'gt:0'],
            'key'               => ['required', 'string', 'max:64'],
            'value'             => ['required', 'string', 'max:254'],
            'color'             => ['required', 'numeric', 'gt:-1'],
            'active'            => ['required', 'string', 'in:Yes,No'],
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
