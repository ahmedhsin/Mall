<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !(auth()->check());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>"required|email|unique:users|max:255",
            'password'=>"required|min:8|max:255",
            'phone'=>"required|min:8|max:20|unique:users",
            'name'=>"required|string|max:255"
        ];
    }
}
