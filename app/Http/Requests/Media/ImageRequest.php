<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'images.*'  => 'required|image|max:20000'
        ];
    }

    public function messages()
    {
        return [
            'images.*.required' => 'Вы не выбрали изображения',
            'images.*.image'    => 'Допустимые форматы изображений - jpeg, png, svg, bmp',
            'images.*.max'      => 'Максиммальный размер одного файла - 20 мб',
        ];
    }
}