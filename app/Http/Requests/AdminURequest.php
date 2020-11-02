<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminURequest extends FormRequest
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
            'name_e' => 'required|max:255',
            'rut_e' => 'required|numeric|max:8',
            'email_e' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed'
            ];
    }
}
