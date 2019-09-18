<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateInventoryRequest extends Request
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
        $user = Request::user(); //Get current user
        Request::merge([
                'shop_id' => $user->merchantId(),
                'user_id' => $user->id
            ]);
        incevioAutoloadHelpers(getMysqliConnection());

        return [
            'title' => 'required',
            'sku' => 'required|unique:inventories,sku',
            'sale_price' => 'required|numeric|min:0',
            'offer_price' => 'nullable|numeric',
            'available_from' => 'nullable|date',
            'offer_start' => 'nullable|date|required_with:offer_price|after_or_equal:now',
            'offer_end' => 'nullable|date|required_with:offer_price|after:offer_start',
            'slug' => 'required|unique:inventories,slug',
            'image' => 'mimes:jpeg,png',
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
            'offer_start.required_with' => trans('validation.offer_start_required'),
            'offer_start.after_or_equal' => trans('validation.offer_start_after'),
            'offer_end.required_with' => trans('validation.offer_end_required'),
            'offer_end.after' => trans('validation.offer_end_after'),
        ];
    }
}