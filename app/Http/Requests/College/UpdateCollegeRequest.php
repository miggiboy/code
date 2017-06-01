<?php

namespace App\Http\Requests\College;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCollegeRequest extends FormRequest
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

            'title'             => 'required|max:255|unique:colleges,title,' . $this->college->id,
            'acronym'           => 'nullable|max:255',
            'city_id'           => 'required|integer',
            'has_dormitory'     => 'nullable|boolean',
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

            'title.required'            => 'Название колледжа - обязательное поле.',
            'title.max'                 => 'Название колледжа слишком длинное.',
            'title.unique'              => 'Колледж с таким названием уже существует.',
            
            'acronym.max'               => 'Акроним колледжа слишком длинный.',
            
            'city_id.required'          => 'Город - обязательное поле.',
            'city_id.integer'           => 'Город - неверные данные.', // break-in attempt
            
            'has_dormitory.boolean'     => 'Общежитие - неверные данные.', // break-in attempt
            
            'foundation_year.integer'   => 'Год основания должен быть числом.',
            'foundation_year.between'   => 'Год основания должен быть между 1800 и ' . Carbon::now()->year . ' годами.',
            
            'address.max'               => 'Адрес колледжа слишком длинный.',

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
