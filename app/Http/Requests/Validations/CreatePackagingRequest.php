<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreatePackagingRequest extends Request
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
        Request::merge( array( 'shop_id' => Request::user()->merchantId() ) ); //Set shop_id

        return [
            'name' => 'required',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'depth' => 'required|numeric',
            'cost' => 'numeric|nullable',
            'image' => 'max:' . config('system_settings.max_img_size_limit_kb') . '|mimes:jpg,jpeg,png,gif',
        ];
    }
}
