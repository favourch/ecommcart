<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateAttributeRequest extends Request
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
        Request::merge(['shop_id' => $shop_id]); //Set shop_id

        return [
           'attribute_type_id' => 'required',
           'name' => 'bail|required|composite_unique:attributes,shop_id:'.$shop_id,
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
