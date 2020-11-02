<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnunciosRequest extends FormRequest
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
            'titulo' => 'required',
            'link' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'titulo.required' => 'Debe ingresar el título del anuncio',
            'link.required' => 'Debe ingresar el enlace del anuncio',
            'descripcion.required' => 'Es necesario una breve descripción del anuncio',
            'imagen.required' => 'Debe ingresar una imagen para el anuncio'
        ];   
    }
}
