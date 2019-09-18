<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateAttributeValueRequest extends Request
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
        $ignore = Request::segment(count(Request::segments())); //Current model ID

        return [
           'attribute_id' => 'required',
           'value' => 'bail|required|composite_unique:attribute_values,shop_id:'.$shop_id.', '.$ignore,
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
            'attribute_id.required' => trans('validation.attribute_id_required'),
            'value.required' => trans('validation.attribute_value_required'),
        ];
    }
}
