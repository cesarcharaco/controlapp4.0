<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanesPagosRequest extends FormRequest
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
            'nombre' => 'required|max:255',
            'monto' => 'required|numeric',
            'dias' => 'required|numeric',
            'color' => 'required',
            'tipo' => 'required',
            'imagen' => 'required'
        ];
    }

    public function mesagges()
    {
        return [
            'nombre.required' => 'Debe ingresar un NOMBRE para el Plan de Pago',
            'nombre.max' => 'El NOMBRE no puede contener mas de 255 caracteres',
            'monto.required' => 'Debe ingresar un MONTO para la adquisición del plan',
            'monto.numeric' => 'El MONTO solo debe contener números',
            'dias.required' => 'Debe ingresar los DIAS que estará en vigor el Plan de Pago al anuncio',
            'dias.numeric' => 'los DIAS solo debe contener números',
            'color.required' => 'Debe ingresar un COLOR que represente al Plan de Pago',
            'tipo.required' => 'Debe especificar para quién es el Plan de Pagos',
            'imagen.required' => 'Debe ingresar una imagen que represente al Plan de Pago'
        ];
    }
}
