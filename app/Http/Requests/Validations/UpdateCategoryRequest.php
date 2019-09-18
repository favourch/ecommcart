<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateCategoryRequest extends Request
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
        $id = Request::segment(count(Request::segments())); //Current model ID

        return [
            'category_sub_group_id' => 'required',
            'name' =>  'required|composite_unique:categories, '.$id,
            'slug' =>  'required|composite_unique:categories, '.$id,
            'image' => 'mimes:jpg,jpeg,png',
            'active' => 'required'
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
            // 'attribute_type_id.required' => trans('validation.attribute_type_id_required'),
        ];
    }

}
