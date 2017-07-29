<?php

namespace App\Http\Requests\Profession;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionFormRequest extends FormRequest
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
        $titleRule = 'required|max:255|unique:professions';

        // Skip this article from unique check list on update
        if ($this->method() == 'PATCH') {
            $titleRule .= ',title,' . $this->profession->id;
        }

        return [
            'title'             => $titleRule,
            'category_id'       => 'required|exists:profession_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required'                => 'Название профессии - обязательное поле.',
            'title.max'                     => 'Название профессии слишком длинное.',
            'title.unique'                  => 'Профессия с таким названием уже существует.',

            'category_id.required'          => 'Категория профессии - обязательное поле.',
            'category_id.exists'            => 'Категория профессии - неверные данные.',
        ];
    }
}
