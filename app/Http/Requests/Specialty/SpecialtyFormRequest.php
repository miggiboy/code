<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyFormRequest extends FormRequest
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
        $codeRule = 'nullable|alpha_num|max:255|unique:specialties';

        /**
         * Do not compare this item's code with itself
         * to be unique
         * on update
         */
        if ($this->method() == 'PATCH') {
            $codeRule .= ',code,' . $this->specialty->id;
        }

        return [
            'title'         => 'required|max:255',
            'code'          => $codeRule,
            'subject_1_id'  => 'nullable|integer',
            'subject_2_id'  => 'nullable|integer',
            'type'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Название специальности - обязательное поле.',
            'title.max'             => 'Название специальности слишком длинное.',

            'code.unique'           => 'Cпециальность с таким кодом уже существует.',
            'code.max'              => 'Код специальности слишком длинный.',
            'code.alpha_num'        => 'Код специальности может состоять только из букв и цифр.',

            'subject_1_id.integer'  => 'Предмет 1 - неверные данные.',
            'subject_2_id.integer'  => 'Предмет 2 - неверные данные.',

            'type.required'         => 'Поле тип - обязательное',
        ];
    }
}
