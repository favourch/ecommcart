<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\Message;
use App\EmailTemplate;
use App\Http\Requests\Request;

class CreateMessageRequest extends Request
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
            'shop_id' => Auth::user()->merchantId(),
            'user_id' => Auth::user()->id,
            'label' => (Request::has('draft')) ? Message::LABEL_DRAFT : Message::LABEL_SENT,
        ]); //Set shop_id

        if (Request::has('email_template_id')) {
            $template = EmailTemplate::find(Request::input('email_template_id'));
            Request::merge([
                'subject' => $template->subject,
                'message' => $template->body
            ]);
        }

        return [
           'subject' => 'required_without:email_template_id',
           'message' => 'required_without:email_template_id',
           'email_template_id' => 'required_without_all:subject,message',
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
            'subject.required_without' => trans('validation.subject_required_without'),
            'message.required_without' => trans('validation.message_required_without'),
            'email_template_id.required_without_all' => trans('validation.template_id_required_without_all'),
            'customer_id.required' => trans('validation.customer_required'),
        ];
    }
}
