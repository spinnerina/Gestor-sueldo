<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'cuit' => 'nullable|string|max:20',
            'created_by_user_id' => 'nullable|exists:users,id',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la empresa es requerido',
            'name.string' => 'El nombre de la empresa debe ser una cadena de texto',
            'name.max' => 'El nombre de la empresa no debe exceder los 255 caracteres',
            'cuit.string' => 'El CUIT debe ser una cadena de texto',
            'cuit.max' => 'El CUIT no debe exceder los 20 caracteres',
            'created_by_user_id.exists' => 'El usuario creador no existe',
            'status.boolean' => 'El estado debe ser un booleano',
        ];
    }
}
