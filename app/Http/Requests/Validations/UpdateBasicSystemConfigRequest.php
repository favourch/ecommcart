<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateBasicSystemConfigRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Request::user()->isSuperAdmin();
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
           'legal_name' => 'required',
           'timezone_id' => 'required',
           'email' =>  'required|email|max:255',
           'icon' => 'max:' . config('system_settings.max_img_size_limit_kb') . '|mimes:jpg,jpeg,png',
           'logo' => 'max:' . config('system_settings.max_img_size_limit_kb') . '|mimes:jpg,jpeg,png',
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
            'logo.max' => trans('validation.brand_logo_max'),
            'logo.mimes' => trans('validation.brand_logo_mimes'),
        ];
    }
}
