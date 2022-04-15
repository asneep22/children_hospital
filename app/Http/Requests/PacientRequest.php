<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PacientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => 'required',
            'pname' => 'required',
            'surname' => 'required',
            'birthday' => 'required',
            'uchastok_id' => 'required',
            'roddom_id' => 'required',
            'rost' => 'required',
            'ves' => 'required',
            'gestaci' => 'required',
            'recommend'
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => "Поле 'Фамилия' обязательно для заполнения",
            'pname.required' => "Поле 'Имя' обязательно для заполнения",
            'surname.required' => "Поле 'Отчество' обязательно для заполнения",
            'birthday.required' => "Поле 'Дата рождения' обязательно для заполнения",
            'uchastok_id.required' => "Поле 'Участок' обязательно для заполнения",
            'roddom_id.required' => "Поле 'Роддом' обязательно для заполнения",
            'rost.required' => "Поле 'Рост' обязательно для заполнения",
            'ves.required' => "Поле 'Вес' обязательно для заполнения",
            'gestaci.required' => "Поле 'Неделя рождения' обязательно для заполнения",
        ];
    }

}
