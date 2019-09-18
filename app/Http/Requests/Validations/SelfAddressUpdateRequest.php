<?php

namespace App\Http\Requests\Validations;

use App\Customer;
use App\Http\Requests\Request;

class SelfAddressUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user() instanceof Customer) {
            return $this->route('address')->addressable_id == $this->user()->id
                    && $this->route('address')->addressable_type == 'App\Customer';
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'address_type' => 'bail|required|exists:address_types,type|composite_unique:addresses,addressable_id,addressable_type,' . $this->route('address')->id,
           'address_line_1' => 'required',
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
