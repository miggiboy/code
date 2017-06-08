<?php

namespace App\Http\Requests\Advertisements;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertisementRequest extends FormRequest
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
            'description'   => 'required|max:500',
            'type'          => 'required|max:256',
            'url'           => 'nullable|max:500',
            // 'media.*'       => 'required|mimes:jpeg,bmp,png,jpg,svg,gif',
            // 'screenshot'    => 'nullable|mimes:jpeg,bmp,png,jpg,svg,gif',
        ];
    }

    public function messages()
    {
        return [
            'description.required'  => 'Описание рекламы - обязательное поле',
            'description.max'       => 'Описание рекламы слишком длинное',

            'type.required'  => 'Тип рекламы - обязательное поле',
            'type.max'       => 'Тип рекламы слишком длинное',

            'url.max'  => 'Ссылка слишком длинная',
        ];
    }
}
