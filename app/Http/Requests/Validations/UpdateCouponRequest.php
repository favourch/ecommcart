<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateCouponRequest extends Request
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
       'value' => 'required|numeric',
       'type' => 'required',
       'quantity' => 'required|integer',
       'min_order_amount' => 'nullable|numeric',
       'quantity_per_customer' => 'nullable|integer',
       'starting_time' => 'required|nullable|date',
       'ending_time' => 'required|nullable|date|after:starting_time',
       'active' => 'required|boolean',
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
            'ending_time.after' => trans('validation.offer_end_after'),
        ];
    }

}
