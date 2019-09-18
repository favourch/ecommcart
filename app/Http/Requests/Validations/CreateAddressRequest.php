<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateAddressRequest extends Request
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
           'address_type' => 'bail|sometimes|exists:address_types,type|composite_unique:addresses,addressable_id,addressable_type',
           'address_line_1' => 'required',
           'zip_code' => 'required',
           'country_id' => 'required|integer',
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
            'address_type.composite_unique' => trans('validation.composite_unique'),
        ];
    }
}
