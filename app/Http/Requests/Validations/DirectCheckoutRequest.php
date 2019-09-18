<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class DirectCheckoutRequest extends Request
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
        // $shop_id = Request::user()->merchantId(); //Get current user's shop_id
        // Request::merge(['shop_id' => $shop_id]); //Set shop_id

        // $rules = [
        //     'email' =>  'nullable|email|max:255|unique:customers',
        //     'password' =>  'nullable|required_with:email|confirmed|min:6',
        // ];

        // if( 'saved_card' != $this->payment_method )
        //     $rules['payment_method'] = ['required', 'exists:payment_methods,id,enabled,1'];

        // return $rules;

        return [];
    }


   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'attribute_type_id.required' => trans('validation.attribute_type_id_required'),
    //     ];
    // }
}
