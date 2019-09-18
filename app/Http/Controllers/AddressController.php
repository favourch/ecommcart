<?php

namespace App\Http\Controllers;

use App\State;
use App\Address;
use Illuminate\Http\Request;
use App\Repositories\Address\AddressRepository;
use App\Http\Requests\Validations\CreateAddressRequest;
use App\Http\Requests\Validations\UpdateAddressRequest;

class AddressController extends Controller
{
    private $model_name;

    private $address;

    /**
     * construct
     */
    public function __construct(AddressRepository $address)
    {
        parent::__construct();

        $this->model_name = trans('app.model.address');
        $this->address = $address;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addresses($addressable_type, $addressable_id)
    {
        $data = $this->address->addresses($addressable_type, $addressable_id);

        return view('address.show', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($addressable_type, $addressable_id)
    {
        $addressable_type = get_qualified_model($addressable_type);

        return view('address._create', compact(['addressable_type', 'addressable_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAddressRequest $request)
    {
        $this->address->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address = $this->address->find($id);

        return view('address._edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressRequest $request, $id)
    {
        $this->address->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->address->destroy($id);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Response AJAX call to return states of a give country
     */
    public function ajaxCountryStates(Request $request)
    {
        if ($request->ajax()){
            $states = $this->address->getStates($request->input('id'));

            return response($states, 200);
        }

        return response('Not allowed!', 404);
    }
}