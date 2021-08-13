<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'username' => 'bail|required|min:6|unique:users',
            'password' => 'bail|required|min:8|max:255',
            'name' => 'bail|required|min:8',
            'email' => 'bail|required|min:8|email',
            'phone' => 'bail|required|numeric',
            'address' => 'bail|required|min:8|max:255',
        ];
    }
}
