<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveClienteRequest extends FormRequest
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
            'cif' => ['required'],
            'nombre' => ['required'],
            'telefono' => ['required'],
            'correo' => ['required', 'email'],
            'cuota_mensual' => ['required'],
            'cuenta_corriente' => ['required'],
            'pais_id' => ['required'],
        ];
    }
}
