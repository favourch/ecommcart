<?php
namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Common\Authorizable;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepository;
use App\Http\Requests\Validations\CreateCustomerRequest;
use App\Http\Requests\Validations\UpdateCustomerRequest;

class CustomerController extends Controller
{
    use Authorizable;

    private $model_name;

    private $customer;

    /**
     * construct
     */
    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();

        $this->model_name = trans('app.model.customer');

        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $customers = $this->customer->all();

        $trashes = $this->customer->trashOnly();

        return view('admin.customer.index', compact('trashes'));
    }

    // function will process the ajax request
    public function getCustomers(Request $request) {

        $customers = $this->customer->all();

        return Datatables::of($customers)
            ->addColumn('option', function ($customer) {
                return view( 'admin.partials.actions.customer.options', compact('customer'));
            })
            ->editColumn('nice_name',  function ($customer) {
                return view( 'admin.partials.actions.customer.nice_name', compact('customer'));
            })
            ->editColumn('name', function($customer){
                return view( 'admin.partials.actions.customer.full_name', compact('customer'));
            })
            ->editColumn('orders_count', function($customer){
                return view( 'admin.partials.actions.customer.orders_count', compact('customer'));
            })
            ->rawColumns([ 'nice_name', 'name', 'orders_count', 'option' ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->customer->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $custidomer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer->find($id);

        return view('admin.customer._show', compact('customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addresses($id)
    {
        $customer = $this->customer->find($id);

        $addresses = $this->customer->addresses($customer);

        return view('address.show', compact('customer', 'addresses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $customer = $this->customer->profile($id);

        return view('admin.customer.profile', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = $this->customer->find($id);

        return view('admin.customer._edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.customers', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->customer->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.customers', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->customer->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->customer->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
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
        $this->customer->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
