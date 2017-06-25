<?php

namespace App\Http\Requests\Institution;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class InstitutionFormRequest extends FormRequest
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
        $titleRule = 'required|max:255|unique:institutions';

        /**
         * Do not compare this item's title with itself
         * to be unique on update
         */
        if ($this->method() == 'PATCH') {
            $titleRule .= ',title,' . $this->institution->id;
        }

        return [
            'title'             => $titleRule,
            'abbreviation'      => 'nullable|max:255',
            'city_id'           => 'required|integer',
            'type'              => 'required',
            'is_paid'           => 'required|boolean',
            'has_dormitory'     => 'nullable|boolean',
            'has_military_dep'  => 'nullable|boolean',
            'foundation_year'   => 'nullable|integer|between:1800,' . Carbon::now()->year,
            'address'           => 'nullable|max:255',
            'web_site'          => 'nullable|max:255',
            'phone_number'      => 'nullable|max:255',

            'reception.address' => 'nullable|max:255',
            'reception.email'   => 'nullable|email|max:255',
            'reception.phone'   => 'nullable|max:255',
            'reception.phone_2' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [

            'title.required'            => 'Название - обязательное поле.',
            'title.max'                 => 'Название слишком длинное.',
            'title.unique'              => 'Уч. заведение с таким названием уже существует.',

            'abbreviation.max'          => 'Аббревиатура слишком длинная.',

            'city_id.required'          => 'Город - обязательное поле.',
            'city_id.integer'           => 'Город - неверные данные.',

            'type.required'             => 'Тип - обязательное поле',

            'is_paid.required'          => 'Нужно указать является ли уч. заведеие платником',
            'is_paid.boolean'           => 'Поле \"платник\" - обязательное',

            'has_dormitory.boolean'     => 'Общежитие - неверные данные.',
            'has_military_dep.boolean'  => 'Военная.каф - неверные данные.',

            'foundation_year.integer'   => 'Год основания должен содержать только числа.',
            'foundation_year.between'   => 'Год основания должен быть между 1800 и ' . Carbon::now()->year . ' годами.',

            'address.max'               => 'Адрес слишком длинный.',

            'web_site.max'              => 'Адрес веб-сайта слишком длинный',
            'phone_number.max'          => 'Основной телефон слишком длинный',

            'reception.address.max'     => 'Адрес приемной комиссии слишком длинный.',

            'reception.email.email'     => 'Email приемной комиссии - неверный формат.',
            'reception.email.max'       => 'Email приемной комиссии слишком длинный.',

            'reception.phone.max'       => 'Телефон приемной комиссии слишком длинный.',
            'reception.phone_2.max'     => 'Доп. телефон приемной комиссии слишком длинный.',
        ];
    }
}
