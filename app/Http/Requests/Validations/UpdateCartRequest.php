<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateCartRequest extends Request
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
            'cart.*.inventory_id' => 'required',
            'cart.*.item_description' => 'required',
            'cart.*.quantity' => 'required',
            'cart.*.unit_price' => 'required',
            'payment_method_id' => 'required',
            'payment_status' => 'required',
            'customer_id' => 'required',
        ];
    }
}
