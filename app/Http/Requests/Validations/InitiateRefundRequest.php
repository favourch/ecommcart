<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class InitiateRefundRequest extends Request
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
        $shop_id = Request::user()->merchantId(); //Get current user's shop_id
        Request::merge( array( 'shop_id' => $shop_id ) ); //Set shop_id

        return [
           'order_id' => 'required',
           'amount' => 'required|numeric',
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
            'order_id.required' => trans('validation.refund_order_id_required'),
        ];
    }
}
