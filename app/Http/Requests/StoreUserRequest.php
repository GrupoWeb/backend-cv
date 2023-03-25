<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' =>  'required|unique:users,email',
            'password'  => 'required|min:8',
        ];
    }


    /**
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'email.unique'  =>  'error de correo'
        ];
    }
}
