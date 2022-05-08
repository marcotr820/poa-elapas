<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PilarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //////////////////////////// debemos cambiar a true el valor para que nos funciones el request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $gestion = Carbon::now()->addYear();
        $min_gestion = Carbon::now()->subYears(2);
        return [
            'nombre_pilar' => ['required','string'],
            'gestion_pilar' => ['required','numeric',"min:$min_gestion","max:$gestion->year"],
        ];
    }

    public function messages()
    {
        $min_gestion = Carbon::now()->subYears(2)->year;
        return [
            'gestion_pilar.required' => 'El campo gestion es requerido.',
            'gestion_pllar.numeric' => 'El campo gestion debe ser un numero',
            'gestion_pilar.min' => "El campo gestion debe ser mayor a $min_gestion."
        ];
    }
}