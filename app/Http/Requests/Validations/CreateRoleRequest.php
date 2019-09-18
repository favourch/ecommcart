<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateRoleRequest extends Request
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
        $rules = [];
        $rules['name'] = 'bail|required|unique:roles';

        $shop_id = Request::user()->merchantId(); //Get current user's shop_id

        if ($shop_id)
            Request::merge(['shop_id' => $shop_id]); //Set merhant related info
        else
            $rules['public'] = 'required';

        if (Request::user()->accessLevel())
            $rules['level'] = 'nullable|integer|between:'.Request::user()->accessLevel().','.config('system_settings.max_role_level');

        if (Request::input('level') && !Request::user()->accessLevel())
            Request::replace(['level' => Null]); //Reset the level

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'public.required' => trans('validation.role_type_required'),
        ];
    }
}