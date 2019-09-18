<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCategorySubGroupRequest extends Request
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
            'category_group_id' => 'required|integer',
            'name' => 'required|unique:category_sub_groups',
            'slug' => 'required|unique:category_sub_groups',
            'active' => 'required'
        ];
    }
}
