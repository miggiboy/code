<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
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
            'email'        => 'required|email|exists:users,email',
            'password'     => 'required',
        ];
    }

    public function messages()
    {
        return [

            'email.required'   => 'Email - обязательное поле.',
            'email.email'      => 'Email - неверный формат.',
            'email.exists'     => 'Неверный email.',

            'password.required' => 'Пароль - обязательное поле.',
        ];
    }
}
