<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'rut' => 'required|numeric|digits_between:7,8',
            'email' => 'required|email|max:255'
        ];
    }

    public function mesagges()
    {
        return [
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.max' => 'El nombre no puede contener mas de 255 caracteres',
            'apellidos.required' => 'El nombre es obligatorio',
            'apellidos.max' => 'El nombre no puede contener mas de 255 caracteres',
            'rut.required' => 'El RUT es obligatorio',
            'rut.numeric' => 'El RUT solo debe contener números',
            'rut.max' => 'El RUT solo debe contener máximo 8 números',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo debe ser válido',
            'email.max' => 'El correo no debe contener mas de 255 caracteres'

        ];
    }
}
