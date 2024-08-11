<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'code'          => ['required', 'string', 'max:64', Rule::unique('products')->ignore($this->product)],
            'ean'           => ['required', 'numeric', 'gt:0',  Rule::unique('products')->ignore($this->product)],
            'brand'         => ['required', 'string', 'max:250'],
            'name'          => ['required', 'string', 'max:250'],
            // 'description'   => ['nu', 'string'],
            'price'         => ['required', 'numeric', 'gt:0'],
            'vat'           => ['required', 'numeric', 'gt:-1'],
            'value'         => ['required', 'numeric', 'gt:0'],
            'stock'         => ['required', 'numeric', 'gt:-1'],
        ];
    }
}
