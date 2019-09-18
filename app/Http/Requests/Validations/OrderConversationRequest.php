<?php

namespace App\Http\Requests\Validations;

use App\Customer;
use App\Http\Requests\Request;

class OrderConversationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user() instanceof Customer) {
            return $this->route('order')->customer_id == $this->user()->id;
        }
        else{
            return $this->route('order')->shop_id == $this->user()->merchantId();
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|max:500',
            'photo' => 'mimes:jpg,jpeg,png|max:2000',
        ];
    }
}
