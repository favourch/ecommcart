<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\EmailTemplate;
use App\Http\Requests\Request;

class ReplyMessageRequest extends Request
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
        Request::merge(['user_id' => Auth::id()]); //Set shop_id

        if (Request::has('email_template_id')) {
            Request::merge([
                'reply' => EmailTemplate::find(Request::input('email_template_id'))->body
            ]);
        }

        return [
           'reply' => 'required_without:email_template_id',
           'email_template_id' => 'required_without:reply',
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
            'reply.required_without' => trans('validation.reply_required_without'),
            'email_template_id.required_without' => trans('validation.template_id_required_without'),
        ];
    }
}
