<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
        $titleRule = 'required|max:255|unique:articles';

        // Skip this article from unique check list on update
        if ($this->method() == 'PATCH') {
            $titleRule .= ',title,' . $this->article->id;
        }

        return [
            'title'             => $titleRule,
            'short_description' => 'required',
            'full_description'  => 'required',
            'new_category'      => 'required_without:categories|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required'                => 'Название статьи - обязательное поле.',
            'title.unique'                  => 'Статья с таким названием уже существует.',
            'title.max'                     => 'Название статьи слишком длинное.',

            'short_description.required'    => 'Краткое описание - обязательное поле.',
            'full_description.required'     => 'Содержание статьи - обязательное поле.',

            'new_category.required_without' => 'Категория - обязательное поле.',
            'new_category.max'              => 'Слишком длинное название категории.',
        ];
    }
}
