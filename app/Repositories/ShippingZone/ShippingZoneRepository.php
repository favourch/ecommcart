<?php

namespace App\Repositories\ShippingZone;

use Illuminate\Http\Request;

interface ShippingZoneRepository
{
    public function removeCountry(Request $request, $zone, $country);

    public function updateStates(Request $request, $zone, $country);
}