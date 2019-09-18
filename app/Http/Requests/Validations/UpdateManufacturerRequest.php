<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateManufacturerRequest extends Request
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
        $id = Request::segment(count(Request::segments())); //Current model ID

        return [
           'name' => 'bail|required|composite_unique:manufacturers, '.$id,
           'email' =>  'email|max:255|nullable',
           'active' => 'required',
           'image' => 'mimes:jpg,jpeg,png,gif|max:' . config('system_settings.max_img_size_limit_kb'),
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
