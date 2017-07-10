<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class QualificationFormRequest extends FormRequest
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
        $codeRule = 'nullable|alpha_num|max:255|unique:qualifications';

        /**
         * Do not compare this item's code with itself
         * to be unique
         * on update
         */
        if ($this->method() == 'PATCH') {
            $codeRule .= ',code,' . $this->qualification->id;
        }

        return [
            'title'         => 'required|max:255',
            'code'          => $codeRule,
            'specialty_id'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Название - обязательное поле.',
            'title.max'             => 'Название слишком длинное.',

            'code.unique'           => 'Квалицикация с таким кодом уже существует.',
            'code.max'              => 'Код слишком длинный.',
            'code.alpha_num'        => 'Код может состоять только из букв и цифр.',

            'specialty_id.required' => 'Связанная специальноть - обязательное поле',
        ];
    }
}
