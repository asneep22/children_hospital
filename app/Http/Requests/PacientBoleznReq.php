<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PacientBoleznReq extends FormRequest
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
            'bolezn_id' => 'required',
            'date_in' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'bolezn_id.required' => "Поле 'Болезнь' обязательно для заполнения",
            'date_in.required' => "Поле 'Дата начала' обязательно для заполнения",
        ];
    }
}
