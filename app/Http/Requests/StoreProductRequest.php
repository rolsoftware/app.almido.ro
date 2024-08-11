<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id'   => ['required', 'numeric', 'gt:0'],
            'code'          => ['required', 'string', 'max:64'],
            'ean'           => ['required', 'numeric', 'gt:0'],
            'brand'         => ['required', 'string', 'max:250'],
            'name'          => ['required', 'string', 'max:250'],
            'description'   => ['required', 'string'],
            'price'         => ['required', 'numeric', 'gt:0'],
            'vat'           => ['required', 'numeric', 'gt:-1'],
            'value'         => ['required', 'numeric', 'gt:0'],
        ];
    }
}
