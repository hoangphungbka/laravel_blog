<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:8|max:255',
            'description' => 'bail|required|between:10,500',
            'price' => 'bail|required|numeric',
            'discount' => 'bail|required|numeric|between:0,50',
            'image' => $this->route('product') ? 'nullable' : 'required',
            'category_id' => 'bail|required|exists:categories,id',
            'brand_id' => 'bail|required|exists:brands,id',
            'color_id' => 'bail|required|exists:colors,id',
            'status' => 'bail|required|boolean',
            'sizes' => 'bail|required|array',
            'sizes.*' => 'distinct',
            'quantities' => 'bail|required|array',
        ];
    }
}
