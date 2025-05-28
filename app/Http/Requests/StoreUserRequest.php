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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'ci' => 'required|string|max:9|unique:users,ci',
            'program_id' => 'required|exists:programs,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.max' => 'El correo electrónico no debe exceder 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'ci.required' => 'La cédula es obligatoria.',
            'ci.string' => 'La cédula debe ser una cadena de texto.',
            'ci.max' => 'La cédula no debe exceder 9 caracteres.',
            'ci.unique' => 'La cédula ya está registrada.',
            'program_id.required' => 'El programa es obligatorio.',
            'program_id.exists' => 'El programa seleccionado no es válido.',
            'role_id.required' => 'El rol es obligatorio.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ];
    }
}
