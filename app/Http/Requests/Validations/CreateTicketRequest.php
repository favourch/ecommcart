<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\Http\Requests\Request;

class CreateTicketRequest extends Request
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
        Request::merge([
            'shop_id' => Request::user()->merchantId(),
            'user_id' => Auth::id(),
        ]); //Set shop_id

        return [
           'subject' => 'required',
           'message' => 'required',
           'category_id' => 'required',
           'priority' => 'required',
        ];
    }
}
