<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyReportRequest extends FormRequest
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
            'hide_arrived_at' => 'required|date',
            'hide_completed_at' => 'required|date',
            'arrived_at_hour' => 'required|numeric|min:0|max:23',
            'completed_at_hour' => 'required|numeric|min:0|max:23',
        ];
    }
}
