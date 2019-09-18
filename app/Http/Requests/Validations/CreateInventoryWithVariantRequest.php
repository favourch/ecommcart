<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateInventoryWithVariantRequest extends Request
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
        // echo "<pre>"; print_r(Request::all()); echo "</pre>"; exit();
        $user = Request::user(); //Get current user
        Request::merge([
                        'shop_id' => $user->shop_id,
                        'user_id' => $user->id
                    ]); //Set user_id

        return [
            'title' => 'required',
            'variants.*' => 'required',
            'sku.*' => 'required|distinct|unique:inventories,sku',
            'sale_price.*' => 'bail|required|numeric|min:0',
            'stock_quantity.*' => 'bail|required|integer',
            'offer_price.*' => 'sometimes|nullable|numeric',
            'available_from' => 'nullable|date',
            'description' => 'required',
            'offer_start' => 'nullable|required_with:offer_price.*|date|after_or_equal:now',
            'offer_end' => 'nullable|required_with:offer_price.*|date|after:offer_start.*',
            'image.*' => 'mimes:jpeg,png',
        ];
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages =  [
            'variants.*.required' => trans('validation.variants_required'),
            'offer_start.*.required_with' => trans('validation.offer_start_required'),
            'offer_start.after' => trans('validation.offer_start_after'),
            'offer_end.required_with' => trans('validation.offer_end_required'),
            'offer_end.after' => trans('validation.offer_end_after'),
        ];

        foreach($this->request->get('sku') as $key => $val){
            $messages['sku.'.$key.'.unique'] = trans('validation.sku-unique', ['attribute' => $key+1, 'value' => $val]);
            $messages['sku.'.$key.'.distinct'] = trans('validation.sku-distinct', ['attribute' => $key+1]);
        }

        foreach($this->request->get('offer_price') as $key => $val){
            $messages['offer_price.'.$key.'.numeric'] = $val .' '. trans('validation.offer_price-numeric');
        }

        return $messages;
    }
}