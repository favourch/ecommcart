<?php namespace App\Http\Controllers\Admin;

use DB;
use Log;
use Auth;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Events\Shop\ShopCreated;
use App\Events\User\UserCreated;
use App\Jobs\CreateShopForMerchant;
use App\Http\Controllers\Controller;
use App\Repositories\Merchant\MerchantRepository;
use App\Http\Requests\Validations\CreateMerchantRequest;
use App\Http\Requests\Validations\UpdateMerchantRequest;

class MerchantController extends Controller
{
    use Authorizable;

    private $model_name;

    private $merchant;

    /**
     * construct
     */
    public function __construct(MerchantRepository $merchant)
    {
        parent::__construct();

        $this->model_name = trans('app.model.merchant');

        $this->merchant = $merchant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchants = $this->merchant->all();

        $trashes = $this->merchant->trashOnly();

        return view('admin.merchant.index', compact('merchants', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.merchant._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMerchantRequest $request)
    {
        // echo "<pre>"; print_r($request->all()); echo "</pre>"; exit();
        // Start transaction!
        DB::beginTransaction();

        try {
            $merchant = $this->merchant->store($request);

            // Dispatching Shop create job
            CreateShopForMerchant::dispatch($merchant, $request->all());

        } catch(\Exception $e){

            // rollback the transaction and log the error
            DB::rollback();
            Log::error('Vendor Creation Failed: ' . $e->getMessage());

            // add your error messages:
            $error = new \Illuminate\Support\MessageBag();
            $error->add('errors', trans('responses.vendor_config_failed'));

            return back()->withErrors($error);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        // Trigger user created event
        event(new UserCreated($merchant, auth()->user()->getName(), $request->get('password')));

        // Trigger shop created event
        event(new ShopCreated($merchant->owns));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $merchant = $this->merchant->find($id);

        return view('admin.merchant._show', compact('merchant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merchant = $this->merchant->find($id);

        return view('admin.merchant._edit', compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMerchantRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.users', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->merchant->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.users', 3) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->merchant->trash($id);

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
        $this->merchant->restore($id);

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
        $this->merchant->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
