<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyNominateRequestRequest extends FormRequest
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
            //
            'carrier_id' => 'required',
            'estimate_close_at' => 'required',
            'hide_estimate_close_at' => 'required|date|after:today',
            'estimate_close_at_hour' => 'required',
            'estimate_close_at_minutes' => 'required',
        ];
    }
}
