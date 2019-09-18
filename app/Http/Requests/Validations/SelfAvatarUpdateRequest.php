<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class SelfAvatarUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::guard('customer')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'avatar' => 'required|mimes:jpeg,jpg,png',
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
            'avatar.required' => trans('validation.avatar_required'),
        ];
    }
}
