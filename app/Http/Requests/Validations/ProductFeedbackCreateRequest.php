<?php

namespace App\Http\Requests\Validations;

use App\Customer;
use App\Http\Requests\Request;

class ProductFeedbackCreateRequest extends Request
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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Request::merge(['customer_id' => $this->user()->id]); //Set customer_id

        return [
           'items.*.rating' => 'required|integer|between:1,5',
           'items.*.comment' => 'nullable|string|min:10|max:250',
        ];
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        // Check if nothing submited
        if(! $this->request->get('items')) return [];

        $messages = [];
        foreach($this->request->get('items') as $key => $val) {
            $messages['items.'.$key.'.rating.required'] = trans('theme.validation.feedback_rating_issue');
            $messages['items.'.$key.'.rating.between'] = trans('theme.validation.feedback_rating_issue');
            $messages['items.'.$key.'.comment.min'] = trans('theme.validation.feedback_comment_between',['min'=>10,'max'=>250]);
            $messages['items.'.$key.'.comment.max'] = trans('theme.validation.feedback_comment_between',['min'=>10,'max'=>250]);
        }

        return $messages;
    }
}
