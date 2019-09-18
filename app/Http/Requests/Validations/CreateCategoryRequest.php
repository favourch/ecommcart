<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCategoryRequest extends Request
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
           'category_sub_group_id' => 'required',
           'name' => 'required|unique:categories',
           'slug' => 'required|unique:categories',
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
            // 'address_type.composite_unique' => trans('validation.composite_unique'),
        ];
    }

}
