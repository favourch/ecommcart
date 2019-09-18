<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\ShippingRate\ShippingRateRepository;
use App\Http\Requests\Validations\CreateShippingRateRequest;
use App\Http\Requests\Validations\UpdateShippingRateRequest;

class ShippingRateController extends Controller
{
    use Authorizable;

    private $model_name;

    private $shipping_rate;

    /**
     * construct
     */
    public function __construct(ShippingRateRepository $shipping_rate)
    {
        parent::__construct();

        $this->model_name = trans('app.model.shipping_rate');

        $this->shipping_rate = $shipping_rate;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int $shippingZone
     * @param  str $basedOn
     * @return \Illuminate\Http\Response
     */
    public function create($shippingZone, $basedOn = 'price')
    {
        return view('admin.shipping_rate._create', compact('shippingZone', 'basedOn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateShippingRateRequest $request)
    {
        $this->shipping_rate->store($request);

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
        $shipping_rate = $this->shipping_rate->find($id);

        return view('admin.shipping_rate._edit', compact('shipping_rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingRateRequest $request, $id)
    {
        $this->shipping_rate->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
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
        $this->shipping_rate->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
