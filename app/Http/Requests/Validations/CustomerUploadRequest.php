<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CustomerUploadRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', \App\Customer::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customers' => 'required|file|mimes:csv,txt'
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
            'customers.mimes' => trans('validation.csv_mimes'),
        ];
    }
}
