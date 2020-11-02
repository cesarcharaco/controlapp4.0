<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => 'required|max:255',
            'rut' => 'required|numeric|digits_between:7,8|unique:users_admin',
            'email' => 'required|email|max:255|unique:users_admin',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function mesagges()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre no puede contener mas de 255 caracteres',
            'rut.required' => 'El RUT es obligatorio',
            'rut.numeric' => 'El RUT solo debe contener números',
            'rut.max' => 'El RUT solo debe contener máximo 8 números',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo debe ser válido',
            'email.max' => 'El correo no debe contener mas de 255 caracteres',
            'email.unique' => 'Correo ya registrado',
            'password.required' => 'El Password es obligatorio',
            'password.min' => 'El Password debe contener mas de 5 dígitos',
            'password.confirmed' => 'El Password no coincide con la confirmacion'

        ];
    }
}
