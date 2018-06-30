<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyContactRequest extends FormRequest
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
            'type_id' => 'required',
            'sei' => 'required',
            'mei' => 'required',
            'email' => 'required|confirmed',
            'tel' => 'required',
            'body' => 'required|max:500|min:20',
            'accept' => 'accepted',
        ];
    }
}
