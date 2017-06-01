<?php

namespace App\Http\Requests\University;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUniversityRequest extends FormRequest
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
            'title'             => 'required|max:255|unique:universities,title,' . $this->university->id,
            'acronym'           => 'nullable|max:255',
            'city_id'           => 'required|integer',
            'type_id'           => 'nullable|integer',
            'has_dormitory'     => 'nullable|boolean',
            'has_military_dep'  => 'nullable|boolean',
            'foundation_year'   => 'nullable|integer|between:1800,' . Carbon::now()->year,
            'address'           => 'nullable|max:255',
            'web_site'          => 'nullable|max:255',
            'call_center'       => 'nullable|max:255',

            'reception.address' => 'nullable|max:255',
            'reception.email'   => 'nullable|email|max:255',
            'reception.phone'   => 'nullable|max:255',
            'reception.phone_2' => 'nullable|max:255',
        ];
    }

    public function messages() 
    {
        return [
            'title.required'            => 'Название вуза - обязательное поле.',
            'title.max'                 => 'Название вуза слишком длинное.',
            'title.unique'              => 'Вуз с таким названием уже существует.',

            'acronym.max'               => 'Акроним вуза слишком длинный.',

            'city_id.required'          => 'Город - обязательное поле.',
            'city_id.integer'           => 'Город - неверные данные.',

            'type_id.integer'           => 'Тип вуза - неверные данные.',

            'has_dormitory.boolean'     => 'Общежитие - неверные данные.',
            'has_military_dep.boolean'  => 'Военная.каф - неверные данные.',

            'foundation_year.integer'   => 'Год основания должен содержать только числа.',
            'foundation_year.between'   => 'Год основания должен быть между 1800 и ' . Carbon::now()->year . ' годами.',

            'address.max'               => 'Адрес вуза слишком длинный.',

            'web_site.max'              => 'Адрес веб-сайта слишком длинный',
            'call_center.max'           => 'Номер кол-центра слишком длинный',

            'reception.address.max'     => 'Адрес приемной комиссии слишком длинный.',

            'reception.email.email'     => 'Email приемной комиссии - неверный формат.',
            'reception.email.max'       => 'Email приемной комиссии слишком длинный.',

            'reception.phone.max'       => 'Телефон приемной комиссии слишком длинный.',
            'reception.phone_2.max'     => 'Доп. телефон приемной комиссии слишком длинный.',
        ];
    }
}
