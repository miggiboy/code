<?php

namespace App\Http\Requests\Profession;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessionRequest extends FormRequest
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
            'title'             => 'required|max:255|unique:professions,title,' . $this->profession->id,
            'prof_direction_id'  => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required'                => 'Название профессии - обязательное поле.',
            'title.unique'                  => 'Профессия с таким названием уже существует.',
            'title.max'                     => 'Название профессии слишком длинное.',

            'prof_direction_id.required'    => 'Тип профессии - обязательное поле.',
            'prof_direction_id.integer'     => 'Тип профессии - неверные данные.',
        ];
    }
}
