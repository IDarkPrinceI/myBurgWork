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
            'login' => 'min:4|required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
            'name' => 'required',
            'phone' => 'integer|nullable',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Логин - обязательная графа',
            'login.unique' => 'Такой логин уже используется',
            'login.min' => 'Логин должен быть не короче 4 символов',
            'email.required' => 'E-mail - обязательная графа',
            'email.email' => 'E-mail должен соответствовать электронному адресу',
            'email.unique' => 'Такой e-mail уже используется',
            'password.required' => 'Пароль - обязательная графа',
            'name.required' => 'Имя - обязательная графа',
            'phone.integer' => 'Поле "телефон" должно быть числом',
        ];
    }
}
