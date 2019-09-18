<?php

namespace App\Repositories\Customer;

use Auth;
use App\Customer;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCustomer extends EloquentRepository implements BaseRepository, CustomerRepository
{
	protected $model;

	public function __construct(Customer $customer)
	{
		$this->model = $customer;
	}

    public function all()
    {
        return $this->model->with('image', 'primaryAddress')
            ->withCount('orders');
            // ->orderBy('orders_count', 'desc');
            // ->paginate(getPaginationValue());
            // ->get();
    }

    public function trashOnly()
    {
        return $this->model->with('image')->onlyTrashed()->get();
    }

    public function profile($id)
    {
        return $this->model->findOrFail($id);
    }

    public function addresses($customer)
    {
        return $customer->addresses()->get();
    }

    public function store(Request $request)
    {
        $customer = parent::store($request);

        $this->saveAdrress($request->all(), $customer);

        if ($request->hasFile('image'))
            $customer->saveImage($request->file('image'));

        return $customer;
    }

    public function update(Request $request, $id)
    {
        $customer = parent::update($request, $id);

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $customer->deleteImage();

        if ($request->hasFile('image'))
            $customer->saveImage($request->file('image'));

        return $customer;
    }

    public function destroy($id)
    {
        $customer = parent::findTrash($id);

        $customer->flushAddresses();

        $customer->flushImages();

        return $customer->forceDelete();
    }

    public function saveAdrress(array $address, $customer)
    {
        $customer->addresses()->create($address);
    }
}