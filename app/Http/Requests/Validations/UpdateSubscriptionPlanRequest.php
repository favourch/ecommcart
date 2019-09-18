<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateSubscriptionPlanRequest extends Request
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
        $plan = Request::route('subscriptionPlan'); //Current model

        return [
            'name' =>  'required|unique:subscription_plans,name,' . $plan->plan_id . ',plan_id',
            'plan_id' =>  'required|unique:subscription_plans,plan_id,' . $plan->plan_id . ',plan_id',
            'cost' => 'required|numeric|min:0',
            'transaction_fee' => 'nullable|numeric',
            'marketplace_commission' => 'nullable|numeric',
            'team_size' => 'nullable|integer',
            'inventory_limit' => 'nullable|integer',
        ];
    }
}
