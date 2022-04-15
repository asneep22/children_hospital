<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthReq extends FormRequest
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
            'login' => 'required',
            'password'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => "Поле 'Логин' обязательно для заполнения",
            'password.required'=> "Поле 'Пароль' обязательно для заполнения",
        ];
    }
}
