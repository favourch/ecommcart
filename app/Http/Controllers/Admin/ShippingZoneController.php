<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\ShippingZone\ShippingZoneRepository;
use App\Http\Requests\Validations\CreateShippingZoneRequest;
use App\Http\Requests\Validations\UpdateShippingZoneRequest;

class ShippingZoneController extends Controller
{
    use Authorizable;

    private $model_name;

    private $shipping_zone;

    /**
     * construct
     */
    public function __construct(ShippingZoneRepository $shipping_zone)
    {
        parent::__construct();

        $this->model_name = trans('app.model.shipping_zone');

        $this->shipping_zone = $shipping_zone;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_zones = $this->shipping_zone->all();

        return view('admin.shipping_zone.index', compact('shipping_zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping_zone._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShippingZoneRequest $request)
    {
        $this->shipping_zone->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping_zone = $this->shipping_zone->find($id);

        return view('admin.shipping_zone._edit', compact('shipping_zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingZoneRequest $request, $id)
    {
        $this->shipping_zone->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $zone
     * @param  int  $country
     * @return \Illuminate\Http\Response
     */
    public function removeCountry(Request $request, $zone, $country)
    {
        $this->shipping_zone->removeCountry($request, $zone, $country);

        return back()->with('success',  trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  int  $zone
     * @param  int  $country
     * @return \Illuminate\Http\Response
     */
    public function editStates($zone, $country)
    {
        $shipping_zone = $this->shipping_zone->find($zone);

        return view('admin.shipping_zone._states', compact('shipping_zone', 'country'));
    }

    /**
     * Update the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $zone
     * @param  int  $country
     * @return \Illuminate\Http\Response
     */
    public function updateStates(Request $request, $zone, $country)
    {
        $this->shipping_zone->updateStates($request, $zone, $country);

        return back()->with('success',  trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->shipping_zone->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Return tax rate
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function ajaxGetTaxRate(Request $request)
    {
        if ($request->ajax()){
            $taxrate = getTaxRate($request->input('ID'));

            return get_formated_decimal($taxrate, true, 2);
        }

        return false;
    }
}
