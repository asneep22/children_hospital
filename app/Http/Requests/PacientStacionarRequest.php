<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PacientStacionarRequest extends FormRequest
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
          'stacionar_id' => 'required',
          'date_in' => 'required',
          'diagnoz' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'stacionar_id.required' => "Поле 'Стационар' обязательно для заполнения",
            'date_in.required' => "Поле 'Дата поступления' обязательно для заполнения",
            'diagnoz.required' => "Поле 'Диагноз' обязательно для заполнения",
        ];
    }
}
