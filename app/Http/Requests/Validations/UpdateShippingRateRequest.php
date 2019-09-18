<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateShippingRateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = Request::segment(count(Request::segments())); //Current model ID

        $zone = \DB::table('shipping_rates')
                    ->leftJoin('shipping_zones', 'shipping_rates.shipping_zone_id', '=', 'shipping_zones.id')
                    ->select('shipping_zones.shop_id')
                    ->where('shipping_rates.id', $id)
                    ->first();

        return $zone->shop_id == Request::user()->merchantId();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
           'name' => 'required',
           'delivery_takes' => 'required',
           'minimum' => 'required|numeric|min:0',
           'maximum' => 'nullable|numeric|min:'.(int)$this->minimum,
           'rate' => 'required_unless:free_shipping,1',
        ];

        if ($this->has('free_shipping')) {
            Request::merge( ['rate' => Null ] ); //Reset rate
        }

        return $rules;
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'minimum.min' => trans('validation.shipping_range_minimum_min'),
            'maximum.min' => trans('validation.shipping_range_maximum_min'),
            'rate.required_unless' => trans('validation.shipping_rate_required_unless'),
        ];
    }
}
