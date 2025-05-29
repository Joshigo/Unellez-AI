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
        return [
            'pdf' => 'required|file|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'pdf.required' => 'El archivo PDF es obligatorio.',
            'pdf.file' => 'El archivo debe ser un archivo válido.',
            'pdf.mimes' => 'El archivo debe ser un PDF.',
            'pdf.max' => 'El archivo no debe exceder 2 MB.',
        ];
    }
}
