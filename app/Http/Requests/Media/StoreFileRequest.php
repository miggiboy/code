<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'files.*'    => 'file|max:100000',
            'files.0'    => 'required',
            'category'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'files.*.required'  => 'Не выбран файл.',
            'files.*.max'       => 'Максимальный размер одного файла - 100 мб.',

            'category.required' => 'Не задана категория.',
        ];
    }
}
