<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateShippingRateRequest extends Request
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
           'name' => 'required',
           'shipping_zone_id' => 'required|integer',
           'delivery_takes' => 'required',
           'based_on' => 'required',
           'minimum' => 'required|numeric|min:0',
           'maximum' => 'nullable|numeric|min:'.(int)$this->minimum,
           'rate' => 'required_unless:free_shipping,1',
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
            'shipping_zone_id.required' => trans('validation.something_went_wrong'),
            'shipping_zone_id.integer' => trans('validation.something_went_wrong'),
            'based_on.required' => trans('validation.something_went_wrong'),
            'minimum.min' => trans('validation.shipping_range_minimum_min'),
            'maximum.min' => trans('validation.shipping_range_maximum_min'),
            'rate.required_unless' => trans('validation.shipping_rate_required_unless'),
        ];
    }

}
