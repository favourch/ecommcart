<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class ContactUsRequest extends Request
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
         'name' => 'required',
         'phone' => 'nullable|string|max:50',
         'email' => 'required|email',
         'subject' => 'required|max:200',
         'message' => 'required|max:500',
         'g-recaptcha-response' => 'required|recaptcha'
      ];
    }
}
