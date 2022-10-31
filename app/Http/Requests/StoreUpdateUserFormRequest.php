<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $uuid = $this->uuid ?? '';
        $rules = [
            'username' => ['required', 'string', 'min:3', 'max:150', "unique:users,username,{$uuid},uuid"],
            'password' => ['required', 'string', 'min:8'],
        ];

        if ($this->method('PUT')) {
            $rules['password'] = ['nullable', 'string', 'min:8'];
        };

        return $rules;
    }
}
