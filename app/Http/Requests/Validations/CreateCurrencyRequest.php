<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCurrencyRequest extends Request
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
        return [
           'name' => 'required|string',
           'iso_code' => 'required|size:3|unique:currencies',
           'symbol' => 'required',
           'subunit' => 'required',
           'decimal_mark' => 'required',
           'thousands_separator' => 'required',
           'symbol_first' => 'required'
        ];
    }
}
