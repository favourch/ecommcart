<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateSupplierRequest extends Request
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
           'name' => 'bail|required|composite_unique:suppliers,shop_id:'.$shop_id,
           'email' =>  'nullable|email|max:255|composite_unique:suppliers,shop_id:'.$shop_id,
           'active' => 'required',
           'image' => 'max:' . config('system_settings.max_img_size_limit_kb') . '|mimes:jpg,jpeg,png,gif',
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
            'image.max' => trans('validation.brand_logo_max'),
            'image.mimes' => trans('validation.brand_logo_mimes'),
        ];
    }
}
