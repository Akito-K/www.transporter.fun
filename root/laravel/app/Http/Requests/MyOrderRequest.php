<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
            //
            'name' => 'sometimes|required',

            'send_zip1' => 'required|digits:3',
            'send_zip2' => 'required|digits:4',
            'send_zip_code' => 'requires|numeric',
            'send_city' => 'required',
            'send_address' => 'required',

            'arrive_zip1' => 'required|digits:3',
            'arrive_zip2' => 'required|digits:4',
            'arrive_zip_code' => 'requires|numeric',
            'arrive_city' => 'required',
            'arrive_address' => 'required',
        ];
    }
}
