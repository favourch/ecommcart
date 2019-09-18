<?php

namespace App\Repositories\ShippingZone;

use Auth;
use App\ShippingZone;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentShippingZone extends EloquentRepository implements BaseRepository, ShippingZoneRepository
{
	protected $model;

	public function __construct(ShippingZone $shipping_zone)
	{
		$this->model = $shipping_zone;
	}

    public function all()
    {
        return $this->model->mine()->with('rates')->get();
    }

    public function update(Request $request, $id)
    {
        $zone = $this->model->findOrFail($id);

        if ($request->has('rest_of_the_world') && $request->input('rest_of_the_world') == 1) {
            $request->merge(['state_ids' => [], 'country_ids' => []]);
        }
        else{
            $state_ids = [];
            if($request->has('country_ids')){
                $country_ids = $request->input('country_ids');
                $old_country_ids = $zone->country_ids; //Current values

                $kept_country_ids = array_intersect($old_country_ids, $country_ids); //Unchanged countries
                $temp_states = get_states_of($kept_country_ids); //All states of unchanged countries
                $kept_state_ids = array_intersect($zone->state_ids, array_keys($temp_states)); //States what will keep unchange

                $new_country_ids = array_diff($country_ids, $old_country_ids); //If there is new countries
                $new_state_ids = get_states_of($new_country_ids); //States of new countries

                $state_ids = array_merge($kept_state_ids, array_keys($new_state_ids)); //Creating new and updated values
            }
            $request->merge(['state_ids' => $state_ids]);
        }

        $zone->update($request->all());

        return $zone;
    }

    public function updateStates(Request $request, $zone, $country)
    {
        $zone = $this->model->findOrFail($zone);

        //Remove all state ids of the country
        $states = get_states_of($country);
        $temp_state_ids = array_diff($zone->state_ids, array_keys($states));

        //Creating new and updated values
        $state_ids = array_merge($temp_state_ids, $request->input('states'));

        $zone->state_ids = $state_ids;
        $zone->save();

        return $zone;
   }

    public function removeCountry(Request $request, $id, $country)
    {
        $zone = $this->model->findOrFail($id);

        //Remove state ids of the country
        $old_states = $zone->state_ids;
        $states = get_states_of($country);
        $state_ids = array_diff($old_states, array_keys($states));

        //Remove country id
        $country_ids = $zone->country_ids;
        $find = array_search($country, $country_ids);
        unset($country_ids[$find]);

        //Save the new values
        $zone->country_ids = $country_ids;
        $zone->state_ids = $state_ids;
        $zone->save();

        return $zone;
    }

    public function destroy($id)
    {
        return $this->model->findOrFail($id)->forceDelete();
    }
}