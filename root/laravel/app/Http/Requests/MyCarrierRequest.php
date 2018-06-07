<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyCarrierRequest extends FormRequest
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
            'sei' => 'required|max:6',
            'mei' => 'required|max:6',
            'zip1' => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'pref_id' => 'required',
            'city' => 'required',
            'address' => 'required',
        ];
    }
}
