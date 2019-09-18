<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\Http\Requests\Request;

class ReplyDisputeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::id() == $this->route()->dispute->customer_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Request::merge(['customer_id' => Auth::id()]); //Set shop_id

        return [
            'reply' => 'required',
        ];
    }
}