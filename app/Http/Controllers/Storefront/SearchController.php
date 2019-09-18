<?php

namespace App\Http\Controllers\Storefront;

use Carbon\Carbon;
use App\Category;
use App\Inventory;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
// use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $category = $request->input('in');
        $term = $request->input('search');

        $products = Inventory::search($term)->where('active', 1)->get();
        // echo "<pre>"; print_r($products); echo "</pre>"; exit();
        $products->load(['shop:id,current_billing_plan,active']);

        // Keep results only from active shops
        $products = $products->filter(function ($product) {
            return ($product->shop->current_billing_plan !== Null) && ($product->shop->active == 1);
        });

        if($category != 'all_categories') {
            $category = Category::where('slug', $category)->active()->firstOrFail();
            $listings = $category->listings()->available()->get();
            $products = $products->intersect($listings);
        }

        $products = $products->where('stock_quantity', '>', 0)->where('available_from', '<=', Carbon::now());

        // Attributes for filters
        $brands = ListHelper::get_unique_brand_names_from_linstings($products);
        $priceRange = ListHelper::get_price_ranges_from_linstings($products);

        if($request->has('free_shipping')) {
            $products = $products->where('free_shipping', 1);
        }
        if($request->has('new_arrivals')) {
            $products = $products->where('created_at', '>', Carbon::now()->subDays(config('system.filter.new_arrival', 7)));
        }
        if($request->has('has_offers')) {
            $products = $products->where('offer_price', '>', 0)
            ->where('offer_start', '<', Carbon::now())
            ->where('offer_end', '>', Carbon::now());
        }

        if($request->has('sort_by')) {
            switch ($request->get('sort_by')) {
                case 'newest':
                    $products = $products->sortByDesc('created_at');
                    break;

                case 'oldest':
                    $products = $products->sortBy('created_at');
                    break;

                case 'price_acs':
                    $products = $products->sortBy('sale_price');
                    break;

                case 'price_desc':
                    $products = $products->sortByDesc('sale_price');
                    break;

                case 'best_match':
                default:
                    break;
            }
        }

        if($request->has('condition')) {
            $products = $products->whereIn('condition', array_keys($request->input('condition')));
        }

        if($request->has('price')) {
            $price = explode('-', $request->input('price'));
            $products = $products->where('sale_price', '>=', $price[0])->where('sale_price', '<=', $price[1]);
        }

        if($request->has('brand')) {
            $products = $products->whereIn('brand', array_keys($request->input('brand')));
        }

        $products = $products->paginate(config('system.view_listing_per_page', 16));

        $products->load(['product' => function($q) {
            $q->select('id')->with('categories:id,name,slug');
        }, 'feedbacks:rating,feedbackable_id,feedbackable_type', 'images:path,imageable_id,imageable_type']);

        $categories = $products->pluck('product.categories')->flatten()->unique();

        return view('search_results', compact('products', 'category', 'categories', 'brands', 'priceRange'));
    }
}
