<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateShippingZoneRequest extends Request
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
        $shop_id = Request::user()->merchantId(); //Get current user's shop_id
        $id = Request::segment(count(Request::segments())); //Current model ID

        $rules = [
           'name' => 'bail|required|composite_unique:shipping_zones,shop_id:'.$shop_id.', '.$id,
           'tax_id' => 'required',
           'country_ids' => 'required_unless:rest_of_the_world,1',
           'active' => 'required|boolean',
        ];

        if ($this->has('rest_of_the_world')) {
            $rules['rest_of_the_world'] = 'bail|sometimes|nullable|composite_unique:shipping_zones,shop_id:'.$shop_id.', '.$id;
        }else{
            Request::merge( ['rest_of_the_world' => Null ] ); //Reset rest_of_the_world
        }

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
            'country_ids.required_unless' => trans('validation.shipping_zone_country_ids_required'),
            'tax_id.required' => trans('validation.shipping_zone_tax_id_required'),
            'rest_of_the_world.composite_unique' => trans('validation.rest_of_the_world_composite_unique'),
        ];
    }

}
