<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialtyRequest extends FormRequest
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
            'title'         => 'required|max:255',
            'code'          => 'nullable|alpha_num|unique:specialities|max:255',
            'subject_1_id'  => 'nullable|integer',
            'subject_2_id'  => 'nullable|integer',
            'direction_id'  => 'required|unique:directions,title',
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

            'direction_id.required' => 'Направление - обязательное поле.',
        ];
    }
}
