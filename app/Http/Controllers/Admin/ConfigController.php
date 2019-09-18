<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Shop;
use App\Config;
use App\PaymentMethod;
use App\Http\Requests;
use App\Common\Authorizable;
use App\Events\Shop\ShopIsLive;
use App\Events\Shop\ShopUpdated;
use App\Events\Shop\ConfigUpdated;
use App\Http\Controllers\Controller;
use App\Events\Shop\DownForMaintainace;
use App\Http\Requests\Validations\UpdateConfigRequest;
use App\Http\Requests\Validations\UpdateBasicConfigRequest;
use App\Http\Requests\Validations\ToggleMaintenanceModeRequest;

class ConfigController extends Controller
{
    use Authorizable;

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->model_name = trans('app.model.config');
    }

   /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGeneralSetting()
    {
        $shop = Shop::findOrFail(Auth::user()->merchantId());

        return view('admin.config.general', compact('shop'));
    }

   /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $config = Config::findOrFail(Auth::user()->merchantId());

        $this->authorize('view', $config); // Check permission

        return view('admin.config.index', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBasicConfig(UpdateBasicConfigRequest $request, $id)
    {
        $config = Config::findOrFail($id);

        if( env('APP_DEMO') == true && $config->shop_id <= config('system.demo.shops', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->authorize('update', $config); // Check permission

        $config->shop->update($request->all());

        event(new ShopUpdated($config->shop));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $config->shop->deleteLogo();
        if ($request->hasFile('image'))
            $config->shop->saveImage($request->file('image'));

        if ($request->hasFile('cover_image') || ($request->input('delete_cover_image') == 1))
            $config->shop->deleteFeaturedImage();
        if ($request->hasFile('cover_image'))
            $config->shop->saveImage($request->file('cover_image'), true);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function updateConfig(UpdateConfigRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.shops', 1) )
            return response('error', 444);

        $config = Config::findOrFail($id);

        $this->authorize('update', $config); // Check permission

        if($config->update($request->all())){
            event(new ConfigUpdated($config->shop, Auth::user()));
            return response("success", 200);
        }

        return response('error', 405);
    }

    /**
     * Toggle Maintenance Mode of the given id, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $node
     * @return \Illuminate\Http\Response
     */
    public function toggleNotification(Request $request, $node)
    {
        $config = Config::findOrFail($request->user()->merchantId());

        if( env('APP_DEMO') == true && $config->shop_id <= config('system.demo.shops', 1) )
            return response('error', 444);

        $this->authorize('update', $config); // Check permission

        $config->$node = !$config->$node;

        if($config->save()){
            event(new ConfigUpdated($config->shop, Auth::user()));
            return response("success", 200);
        }

        return response('error', 405);
    }

    /**
     * Toggle Maintenance Mode of the given id, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleMaintenanceMode(ToggleMaintenanceModeRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.shops', 1) )
            return response('error', 444);

        $config = Config::findOrFail($id);

        $this->authorize('update', $config); // Check permission

        $config->maintenance_mode = !$config->maintenance_mode;

        if($config->save()){
            if($config->maintenance_mode)
                event(new DownForMaintainace($config->shop));
            else
                event(new ShopIsLive($config->shop));

            return response("success", 200);
        }

        return response('error', 405);
    }

}
