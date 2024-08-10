<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductCategoryRequest extends FormRequest
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
            'code'          => ['required', 'numeric', 'gt:0', Rule::unique('product_categories')->ignore($this->product_category)],
            'name'          => ['required', 'string', 'max:250'],
            'description'   => ['nullable', 'string', ],
        ];
    }
}
