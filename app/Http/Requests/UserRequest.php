<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
// use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Авторизация пользователя.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Валидация параметров запроса.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required'
        ];
    }


    /**
     * Сообщение в случае не пройденной валидации параметров запроса.
     *
     */
    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json([
         'success'   => false,
         'message'   => 'Validation errors',
         'data'      => $validator->errors()
       ]));
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Параметр name является обязательным',
            'password.required'  => 'Параметр password является обязательным',
        ];
    }
}