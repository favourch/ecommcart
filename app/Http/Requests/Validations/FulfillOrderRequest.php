<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class FulfillOrderRequest extends Request
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
        Request::merge(['order_status_id' => 4]);

        return [
            // 'cart.*.inventory_id' => 'required',
            // 'cart.*.item_description' => 'required',
            // 'cart.*.quantity' => 'required',
            // 'cart.*.unit_price' => 'required',
            'carrier_id' => 'required',
        ];
    }
}