<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateMerchantRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Request::user()->isFromPlatform();
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
           'name' => 'bail|required|max:255',
           'email' =>  'email|max:255|composite_unique:users, '.$id,
           // 'role_id' => 'required',
           'active' => 'required',
           'image' => 'mimes:jpeg,png',
        ];
    }
}
