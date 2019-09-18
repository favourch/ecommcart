<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateCategorySubGroupRequest extends Request
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
            'category_group_id' => 'required|integer',
            'name' =>  'required|composite_unique:category_sub_groups, '.$id,
            'slug' =>  'required|composite_unique:category_sub_groups, '.$id,
            'active' => 'required'
        ];
    }
}
