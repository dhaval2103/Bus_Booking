<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusValidation extends FormRequest
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
        $id = $this->id;
        if ($id) {
            return [
                'busname' => 'required',
                'busno' => 'required|unique:buses,no,' . $id,
                'seat' => 'required',
                'date' => 'required',
                'source'=>'required',
                'destination'=>'required',
                'price'=>'required',
            ];
        } else {
            return [
                'busname' => 'required',
                'busno' => 'required|unique:buses,no',
                'seat' => 'required',
                'date' => 'required',
                'source'=>'required',
                'destination'=>'required',
                'price'=>'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'busname.required' => 'Please Enter Busname',
            'busno.required' => 'Please Enter Busno',
            'seat.required' => 'Please Enter Seat',
            'date.required' => 'Please Choose Date',
            'source.required' => 'Please Choose Source',
            'destination.required' => 'Please Choose Destination',
            'price.required'=>'Please Enter Price',
        ];
    }
}