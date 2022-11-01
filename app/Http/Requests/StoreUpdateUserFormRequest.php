<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUpdateUserFormRequest extends FormRequest
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
        
        $rules = [
            'username' => ['required', 'string', 'min:3', 'max:150', "unique:users"],
            'password' => ['required', 'string', 'min:8'],
        ];

        

        return $rules;
    }

    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([
            'error' => [
                'message' => 'Validation error',
                'details' => $validator->errors()
                    ]    
                ], 400));
            
                

    }

    public function messages()

    {

        return [

            'username.required' => 'Username is required',

            'password.required' => 'Password is required'

        ];

    }

}
