<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SecretLoginRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $impersonate_id = Request::segment(count(Request::segments()));

        return userLevelCompare($impersonate_id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
