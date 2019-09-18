<?php

namespace App\Repositories\Product;

use Auth;
use App\Product;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentProduct extends EloquentRepository implements BaseRepository, ProductRepository
{
	protected $model;

	public function __construct(Product $product)
	{
		$this->model = $product;
	}

	public function all()
	{
        if (Auth::user()->isFromPlatform())
    		return $this->model->with('categories', 'featuredImage', 'image')->withCount('inventories')->get();

        return $this->model->mine()->with('categories', 'featuredImage', 'image')->withCount('inventories')->get();
	}

	public function trashOnly()
	{
        if (Auth::user()->isFromPlatform())
    		return $this->model->onlyTrashed()->with('categories', 'featuredImage')->get();

        return $this->model->mine()->onlyTrashed()->with('categories', 'featuredImage')->get();
	}

    public function store(Request $request)
    {
        $product = parent::store($request);

        if ($request->input('category_list'))
            $product->categories()->sync($request->input('category_list'));

        if ($request->input('tag_list'))
            $product->syncTags($product, $request->input('tag_list'));

        if ($request->hasFile('image'))
            $product->saveImage($request->file('image'), true);

        return $product;
    }

    public function update(Request $request, $id)
    {
        $product = parent::update($request, $id);

        $product->categories()->sync($request->input('category_list', []));

        $product->syncTags($product, $request->input('tag_list', []));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)){
            if($product->featuredImage)
                $product->deleteImage($product->featuredImage);
        }

        if ($request->hasFile('image'))
            $product->saveImage($request->file('image'), true);

        return $product;
    }

	public function destroy($product)
	{
        if(! $product instanceof Product)
            $product = parent::findTrash($product);

        $product->detachTags($product->id, 'product');

        $product->flushImages();

        if($product->hasFeedbacks())
            $product->flushFeedbacks();

        return $product->forceDelete();
	}
}