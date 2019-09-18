<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateBannerRequest;
use App\Http\Requests\Validations\UpdateBannerRequest;

class BannerController extends Controller
{
    use Authorizable;

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::with('group', 'featuredImage', 'images')->orderBy('group_id', 'asc')->get();

        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request)
    {
        $banner = Banner::create($request->all());

        if ($request->hasFile('image'))
            $banner->saveImage($request->file('image'), true);

        if ($request->hasFile('bg_image'))
            $banner->saveImage($request->file('bg_image'));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner._edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $banner->update($request->all());

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)){
            if($banner->featuredImage)
                $banner->deleteImage($banner->featuredImage);
        }

        if ($request->hasFile('image'))
            $banner->saveImage($request->file('image'), true);

        if ($request->hasFile('bg_image') || ($request->input('delete_bg_image') == 1)){
            if($banner->images->first())
                $banner->deleteImage($banner->images->first());
        }

        if ($request->hasFile('bg_image'))
            $banner->saveImage($request->file('bg_image'));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->flushImages();

        $banner->forceDelete();

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
