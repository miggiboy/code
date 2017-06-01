<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email'         => 'required|email|unique:users|max:40',
            'username'      => 'required|unique:users|min:3|max:40',
            'password'      => 'required|min:6|confirmed',
        ];
    }

    public function messages() 
    {
        return [
            'email.required'    => 'Email - обязательное поле.',
            'email.email'       => 'Email - неверный формат.',
            'email.unique'      => 'Этот email занят.',
            'email.max'         => 'Email слишком длиный.',

            'username.required' => 'Логин - обязательное поле.',
            'username.unique'   => 'Этот логин занят.',
            'username.min'      => 'Логин слишком короткий.',
            'username.max'      => 'Логин слишком длинный.',

            'password.required' => 'Пароль - обязательное поле.',
            'password.min'      => 'Пароль должен быть не меньше 6 символов.',
            'password.confirmed'=> 'Пароли не совпадают.',
        ];
    }
}
