<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRequest extends FormRequest
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
        $rules = [
            'type' => 'required|string|in:schedule,pdf',
            // Ahora "keywords" llega como un string separado por comas
            'keywords' => 'nullable|string|max:1000',
        ];

        if ($this->hasFile('file')) {
            $rules['file'] = 'required|file|mimes:pdf,jpeg,png,jpg|max:2048';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'file.required' => 'El archivo es obligatorio.',
            'file.file' => 'El archivo debe ser un archivo válido.',
            'file.mimes' => 'El archivo debe ser PDF o imagen (jpeg, png, jpg).',
            'file.max' => 'El archivo no debe exceder 2 MB.',
            'type.required' => 'El tipo de archivo es obligatorio.',
            'type.in' => 'El tipo de archivo seleccionado es inválido.',
            'keywords.string' => 'Las palabras clave deben ser una cadena de texto.',
        ];
    }
}
