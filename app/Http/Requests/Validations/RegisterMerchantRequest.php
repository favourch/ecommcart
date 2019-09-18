<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class RegisterMerchantRequest extends Request
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
    $this->merge(['role_id' => \App\Role::MERCHANT]);

    return [
        'shop_name' => 'required|string|max:255|unique:shops,name',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'agree' => 'required',
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
        'email.unique' => trans('validation.register_email_unique'),
    ];
  }
}
