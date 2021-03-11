<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'email' => 'email|required|unique:users',
            'password' => 'alpha_num|required|confirmed',
            'name' => 'alpha|nullable',
            'phone' => 'nullable|digits:11',
            'address' => array('regex:/[А-Яа-яЁё0-9.,]/u'),
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'E-mail - обязательная графа',
            'email.email' => 'E-mail должен соответствовать электронному адресу',
            'email.unique' => 'Такой e-mail уже используется',
            'password.required' => 'Пароль - обязательная графа',
            'password.alpha_num' => 'Пароль может состоять только из букв и цифр',
            'password.confirmed' => 'Поля "Пароль" и "Подтверждение пароля" не совпадают',
            'name.alpha' => 'Имя может состоять только из букв',
            'phone.digits' => 'Поле "телефон" должно быть числом образца "89876543210"'
        ];
    }
}
