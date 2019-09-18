<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\Message;
use App\Http\Requests\Request;

class DraftSendRequest extends Request
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
            'user_id' => Auth::id(),
            'label' => (Request::has('draft')) ? Message::LABEL_DRAFT : Message::LABEL_SENT,
        ]); //Set shop_id

        return [
           'subject' => 'required',
           'message' => 'required',
           'customer_id' => 'required',
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
            'customer_id.required' => trans('validation.customer_required'),
        ];
    }
}
