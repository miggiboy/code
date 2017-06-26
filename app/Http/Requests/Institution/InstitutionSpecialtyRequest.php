<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionSpecialtyRequest extends FormRequest
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
            'specialty_details.*.price'        => 'nullable|integer|digits_between:0,11',
            'specialty_details.*.study_period' => 'nullable|max:150',
        ];
    }

    public function messages()
    {
        return [
            'specialty_details.*.price.integer'    => 'Разрешены только цифры',
            'specialty_details.*.digits_between'   => 'Цена - максимум 11 цифр',

            'specialty_details.*.study_period.max' => 'Слишком длинный срок обучения',
        ];
    }
}
