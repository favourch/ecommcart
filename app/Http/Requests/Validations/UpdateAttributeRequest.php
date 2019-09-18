<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateAttributeRequest extends Request
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
           'attribute_type_id' => 'required',
           'name' => 'bail|required|composite_unique:attributes,shop_id:'.$shop_id.', '.$ignore,
           'order' => 'integer|nullable'
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
            'attribute_type_id.required' => trans('validation.attribute_type_id_required'),
        ];
    }

}
