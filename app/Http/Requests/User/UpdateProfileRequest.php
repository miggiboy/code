<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name'       => 'nullable|alpha|max:25',
            'last_name'        => 'nullable|alpha|max:25',
            'email'            => 'email|max:40|unique:users,email,' . auth()->user()->id,
            'username'         => 'max:25|unique:users,username,' . auth()->user()->id,
        ];
    }

    public function messages() 
    {
        return [
            'first_name.alpha' => 'Имя может состоять только из букв.',
            'first_name.max'   => 'Имя сликом длинное, максимум 25 символов.',

            'last_name.alpha'  => 'Фамилия может состоять только из букв.',
            'last_name.max'    => 'Фамилия сликом длинная, максимум 25 символов.',

            'email.email'      => 'Email - неверный формат.',
            'email.unique'     => 'Этот email уже занят.',
            'email.max'        => 'Email слишком длинный.',

            'username.max'     => 'Логин слишком длинный.',
            'username.unique'  => 'Этот логин уже занят.',
        ];
    }
}
