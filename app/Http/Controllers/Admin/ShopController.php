<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Events\Shop\ShopUpdated;
use App\Events\Shop\ShopDeleted;
use App\Http\Controllers\Controller;
use App\Repositories\Shop\ShopRepository;
use App\Http\Requests\Validations\UpdateShopRequest;

class ShopController extends Controller
{
    use Authorizable;

    private $model_name;

    private $shop;

    /**
     * construct
     */
    public function __construct(ShopRepository $shop)
    {
        parent::__construct();

        $this->model_name = trans('app.model.shop');

        $this->shop = $shop;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = $this->shop->all();

        $trashes = $this->shop->trashOnly();

        return view('admin.shop.index', compact('shops', 'trashes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function staffs($id)
    {
        $shop = $this->shop->find($id);

        $staffs = $this->shop->staffs($shop);

        $trashes = $this->shop->staffsTrashOnly($shop);

        return view('admin.shop.staffs', compact('shop', 'staffs', 'trashes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = $this->shop->find($id);

        return view('admin.shop._show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = $this->shop->find($id);

        return view('admin.shop._edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShopRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.shops', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $shop = $this->shop->update($request, $id);

        event(new ShopUpdated($shop));

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
        if( env('APP_DEMO') == true && $id <= config('system.demo.shops', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->shop->trash($id);

        event(new ShopDeleted($id));

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
        $this->shop->restore($id);

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
        $this->shop->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
