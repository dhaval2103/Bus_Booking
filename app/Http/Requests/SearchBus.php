<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchBus extends FormRequest
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
            'source'=>'required',
            'destination'=>'required',
            'date' => 'required',
            'seat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'source.required'=>'Please Choose Source..!!',
            'destination.required'=>'Please Choose Destination..!!',
            'date.required' => 'Please Select Date..!!',
            'seat.required' => 'Please Enter No. Of Seat..!!',
        ];
    }

}