<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateSliderRequest extends Request
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
           'title' => 'max:255',
           'sub_title' => 'max:255',
           'image' => 'required|mimes:jpg,jpeg,png,gif',
           'thumb' => 'mimes:jpg,jpeg,png,gif',
        ];
    }
}
