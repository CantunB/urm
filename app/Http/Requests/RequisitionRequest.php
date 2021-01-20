<?php

namespace Smapac\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionRequest extends FormRequest
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
          'added_on' => 'required',
          'required_on' => 'required',
          'administrative_unit' => 'required',
          // 'departure[]' => 'required',
          // 'quantity[]' => 'required',
          // 'unit[]' => 'required',
          // 'concept[]' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'added_on.required' => 'Ingresa la fecha de solicitud',
            'required_on.required' => 'Ingresa fecha para requerir el material.',
            'administrative_unit.required' => 'Ingresa la unidad administrativa',
            // 'departure[].required' => 'Ingresa la partida',
            // 'quantity[].required' => 'Ingresa la cantidad',
            // 'unit[].required' => 'Ingresa la unidad',
            // 'concept[].required' => 'Ingresa el concepto'
        ];

    }
}
