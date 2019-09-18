<?php

namespace App\Http\Controllers\Api;

use App\Shop;
use App\Product;
use App\Category;
use App\Inventory;
use App\Manufacturer;
use Carbon\Carbon;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ListingResource;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($list = 'latest')
    {
    	switch ($list) {
    		case 'trending':
        		$listings = ListHelper::popular_items(config('system.popular.period.trending', 2), config('system.popular.take.trending', 15));
    			break;

    		case 'popular':
		        $listings = ListHelper::popular_items(config('system.popular.period.weekly', 7), config('system.popular.take.weekly', 5));
    			break;

    		case 'random':
		        $listings = ListHelper::random_items(10);
    			break;

    		case 'latest':
    		default:
		        $listings = ListHelper::latest_available_items(10);
    			break;
    	}

        return ListingResource::collection($listings);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($term)
    {
        $products = Inventory::search($term)->where('active', 1)->get();
        $products->load(['shop:id,current_billing_plan,active']);
        // Keep results only from active shops
        $products = $products->filter(function ($product) {
            return ($product->shop->current_billing_plan !== Null) && ($product->shop->active == 1);
        });

        $products = $products->where('stock_quantity', '>', 0)->where('available_from', '<=', Carbon::now());

        if(request()->has('free_shipping')) {
            $products = $products->where('free_shipping', 1);
        }
        if(request()->has('new_arrivals')) {
            $products = $products->where('created_at', '>', Carbon::now()->subDays(config('system.filter.new_arrival', 7)));
        }
        if(request()->has('has_offers')) {
            $products = $products->where('offer_price', '>', 0)
            ->where('offer_start', '<', Carbon::now())
            ->where('offer_end', '>', Carbon::now());
        }

        if(request()->has('condition')) {
            $products = $products->whereIn('condition', array_keys(request()->input('condition')));
        }

        if(request()->has('price')) {
            $price = explode('-', request()->input('price'));
            $products = $products->where('sale_price', '>=', $price[0])->where('sale_price', '<=', $price[1]);
        }
        $products = $products->paginate(config('system.view_listing_per_page', 16));

        // return json_encode($products);
        return ListingResource::collection($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug item_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function item($slug)
    {
        $item = Inventory::where('slug', $slug)->available()->withCount('feedbacks')->firstOrFail();

        $item->load(['product' => function($q){
                $q->select('id', 'slug', 'manufacturer_id')
                ->withCount(['inventories' => function($query){
                    $query->available();
                }]);
            }, 'attributeValues' => function($q){
                $q->select('id', 'attribute_values.attribute_id', 'value', 'color', 'order')
                ->with('attribute:id,name,attribute_type_id,order');
            },
            'feedbacks.customer:id,nice_name,name',
            'images:path,imageable_id,imageable_type',
        ]);

        // $variants = ListHelper::variants_of_product($item, $item->shop_id);

        // $attr_pivots = \DB::table('attribute_inventory')->select('attribute_id','inventory_id','attribute_value_id')
        // ->whereIn('inventory_id', $variants->pluck('id'))->get();

        // $item_attrs = $attr_pivots->where('inventory_id', $item->id)->pluck('attribute_value_id')->toArray();

        // $attributes = \App\Attribute::select('id','name','attribute_type_id','order')
        // ->whereIn('id', $attr_pivots->pluck('attribute_id'))
        // ->with(['attributeValues' => function($query) use ($attr_pivots) {
        //     $query->whereIn('id', $attr_pivots->pluck('attribute_value_id'))->orderBy('order');
        // }])->orderBy('order')->get();

        // $variants = $variants->toJson(JSON_HEX_QUOT);

        // // TEST
        // $related = ListHelper::related_products($item);
        // $linked_items = ListHelper::linked_items($item);

        // $geoip = geoip(request()->ip()); // Set the location of the user

        return new ItemResource($item);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  str $slug category_slug
     *
     * @return \Illuminate\Http\Response
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        // Take only available items
        $all_products = $category->listings()->available();

        // Filter results
        $listings = $all_products->filter(request()->all())
        ->withCount(['feedbacks', 'orders' => function($q){
            $q->withArchived();
        }])
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->paginate(config('system.view_listing_per_page', 16))->appends(request()->except('page'));

        return ListingResource::collection($listings);
    }

    /**
     * Display a listing of the shop.
     *
     * @param  str $slug shop_slug
     *
     * @return [type]       [description]
     */
    public function shop($slug)
    {
        $shop = Shop::where('slug', $slug)->active()->firstOrFail();

        // Check shop maintenance_mode
        if($shop->isDown())
            return response()->json(['message' => trans('app.marketplace_down')], 404);

        $listings = Inventory::where('shop_id', $shop->id)->filter(request()->all())
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->withCount(['orders' => function($q){
            $q->withArchived();
        }])
        ->available()->paginate(20);

        return ListingResource::collection($listings);
    }

    /**
     * Open brand page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function brand($slug)
    {
        $brand = Manufacturer::where('slug', $slug)->firstOrFail();

        $ids = Product::where('manufacturer_id', $brand->id)->pluck('id');

        $listings = Inventory::whereIn('product_id', $ids)->filter(request()->all())
        ->whereHas('shop', function($q) {
            $q->select(['id', 'current_billing_plan', 'active'])->active();
        })
        ->with(['feedbacks:rating,feedbackable_id,feedbackable_type', 'image:path,imageable_id,imageable_type'])
        ->withCount(['orders' => function($q){
            $q->withArchived();
        }])
        ->active()->paginate(20);

        return ListingResource::collection($listings);
    }

}
