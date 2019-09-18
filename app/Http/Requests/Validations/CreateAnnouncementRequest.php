<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateAnnouncementRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required',
            'action_text' => 'required_with:action_url|max:255',
            'action_url' => 'required_with:action_text',
        ];
    }
}
