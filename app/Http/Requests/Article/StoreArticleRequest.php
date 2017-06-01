<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title'             => 'required|unique:articles|max:255',
            'type'              => 'required|integer',
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
            
            'type.required'                 => 'Тип статьи - обязательное поле.',
            
            'short_description.required'    => 'Краткое описание - обязательное поле.',
            'full_description.required'     => 'Содержание статьи - обязательное поле.',
            
            'new_category.required_without' => 'Категория - обязательное поле.',
            'new_category.max'              => 'Слишком длинное название категории.',
        ];
    }
}
