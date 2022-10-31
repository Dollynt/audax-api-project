<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateArticleFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:30', 'max:70', "unique:articles,title"],
            'resume' => ['required', 'string', 'min:50', 'max:100'],
            'text' => ['required', 'string', 'min:200'],
        ];

        /*if ($this->method('PUT')) {
            $rules['password'] = ['nullable', 'string', 'min:8'];
        };*/

        return $rules;
    }
}
