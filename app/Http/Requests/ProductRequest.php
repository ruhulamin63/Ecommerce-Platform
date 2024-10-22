<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'old_price' => 'nullable|numeric',
            'new_price' => 'required|numeric',
        ];
    }
}
