<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCategoryRequest extends FormRequest
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
            'parent_id'     => ['required', 'numeric', 'gt:-1'],
            'code'          => ['required', 'numeric', 'gt:0', 'unique:product_categories'],
            'name'          => ['required', 'string', 'max:250'],
            'description'   => ['nullable', 'string', ],
        ];
    }
}
