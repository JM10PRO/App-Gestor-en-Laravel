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
            'nif' => ['required'],
            'personacontacto' => ['required'],
            'telefono' => ['required'],
            'correo' => ['required'],
            'poblacion' => ['required'],
            'codpostal' => ['required'],
            'provincia' => ['required'],
            'direccion' => ['required'],
            'fechacreacion' => [''],
            'operario' => [''],
            'fecharealizacion' => ['required'],
            'anotacionanterior' => ['required'],
            'anotacionposterior' => [''],
            'estado' => ['required'],
            'descripcion' => ['required'],
            'ficheroresumen' => ['nullable'],
            'fotos' => ['nullable']
        ];
    }
}
