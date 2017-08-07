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
            $codeRule .= ',code,' . ($this->specialty->id ?? $this->qualification->id);
        }

        return [
            'title'         => 'required|max:255',
            'code'          => $codeRule,
            'subjects.*'    => 'nullable|exists:subjects,id',
            'type'          => 'required|in:specialty,qualification',
            'direction_id'  => 'required_if:type,specialty|exists:specialty_directions,id',
            'parent_id'     => 'nullable|exists:specialties,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required'        => 'Название - обязательное поле.',
            'title.max'             => 'Название слишком длинное.',

            'code.unique'           => 'Этот код уже занят.',
            'code.max'              => 'Код слишком длинный.',
            'code.alpha_num'        => 'Код может состоять только из букв и цифр.',

            'subjects.*.exists'     => 'Предмет - неверные данные.',

            'type.required'         => 'Поле тип - обязательное',
            'type.in'               => 'Поле тип - неверные данные.',

            'direction_id.required_if' => 'Направление - обязательное поле.',
            'direction_id.exists'   => 'Направление - неверные данные.',

            'parent_id.exists'      => 'Родительская специальность - неверные данные.',
        ];
    }
}
