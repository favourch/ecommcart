<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateGiftCardRequest extends Request
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
        $this->merge(['remaining_value' => $this->get('value')]); //Set remaining_value

        return [
           'name' => 'required',
           'value' => 'required|numeric',
           'pin_code' => 'required|unique:gift_cards',
           'serial_number' => 'required|unique:gift_cards',
           'activation_time' => 'required|nullable|date',
           'expiry_time' => 'required|date|after:starting_time',
           'image' => 'mimes:jpg,jpeg,png',
        ];
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'expiry_time.after' => trans('validation.offer_end_after'),
        ];
    }
}