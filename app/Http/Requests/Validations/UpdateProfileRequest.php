<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'name' => 'bail|required|max:255',
           'email' =>  'nullable|email|max:255|unique:users,email, '.auth()->user()->id,
        ];
    }
}
