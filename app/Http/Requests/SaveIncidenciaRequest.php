<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveIncidenciaRequest extends FormRequest
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
            'cif' => ['required', 'min:9'],
            'personacontacto' => ['required'],
            'telefono' => ['required','numeric','min:9','max:12'],
            'correo' => ['required', 'email'],
            'poblacion' => ['required'],
            'codpostal' => ['required'],
            'provincia' => ['required'],
            'direccion' => ['required'],
            'fechacreacion' => ['date'],
            'operario' => ['nullable'],
            'fecharealizacion' => ['required'],
            'anotacionanterior' => ['required'],
            'anotacionposterior' => ['nullable'],
            'estado' => ['required'],
            'descripcion' => ['required'],
            'ficheroresumen' => ['nullable'],
            'fotos' => ['nullable']
        ];
    }
}
