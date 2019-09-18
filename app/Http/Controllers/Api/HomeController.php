<?php

namespace App\Http\Controllers\Api;

use App\Page;
use App\Shop;
use App\Banner;
use App\Slider;
use App\Product;
use App\State;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\PackagingResource;
use App\Http\Resources\PaymentMethodResource;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sliders()
    {
        $sliders = Slider::whereHas('featuredImage')->get();
        return SliderResource::collection($sliders);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banners()
    {
        $banners = Banner::all();
        return BannerResource::collection($banners);
    }

    /**
     * Open shop page
     *
     * @param  slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function offers($slug)
    {
        $product = Product::where('slug', $slug)->with(['inventories' => function($q){
                $q->available();
            }, 'inventories.attributeValues.attribute',
            'inventories.feedbacks',
        ])->firstOrFail();

        return new OfferResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function shop($slug)
    {
        $shop = Shop::where('slug', $slug)->active()
        ->with(['feedbacks' => function($q){
            $q->with('customer:id,nice_name,name')->latest()->take(10);
        }])
        ->withCount(['inventories' => function($q){
            $q->available();
        }])->firstOrFail();

        // Check shop maintenance_mode
        // if(getShopConfig($shop->id, 'maintenance_mode'))
        if($shop->isDown())
            return response()->json(['message' => trans('app.marketplace_down')], 404);

        return new ShopResource($shop);
    }

    /**
     * Return available packaging options for the specified shop.
     *
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function packaging($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();
        $platformDefaultPackaging = new PackagingResource(getPlatformDefaultPackaging());
        $packagings = PackagingResource::collection($shop->activePackagings);

        return $packagings->prepend($platformDefaultPackaging);
        // return new PackagingResource($platformDefaultPackaging);
        // return PackagingResource::collection($shop->activePackagings);
    }

    /**
     * Return available payment options options for the specified shop.
     *
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function paymentOptions($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();

        $paymentMethods = $shop->paymentMethods;
        $activeManualPaymentMethods = $shop->manualPaymentMethods;
        foreach ($paymentMethods as $key => $payment_provider) {
            $has_config = FALSE;
            switch ($payment_provider->code) {
                case 'stripe':
                  $has_config = $shop->stripe ? TRUE : FALSE;
                  // $info = trans('theme.notify.we_dont_save_card_info');
                  break;

                case 'instamojo':
                  $has_config = $shop->instamojo ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_instamojo');
                  break;

                case 'authorize-net':
                  $has_config = $shop->authorizeNet ? TRUE : FALSE;
                  // $info = trans('theme.notify.we_dont_save_card_info');
                  break;

                case 'paypal-express':
                  $has_config = $shop->paypalExpress ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_paypal');
                  break;

                case 'paystack':
                  $has_config = $shop->paystack ? TRUE : FALSE;
                  // $info = trans('theme.notify.you_will_be_redirected_to_paystack');
                  break;

                case 'wire':
                case 'cod':
                    $has_config = in_array($payment_provider->id, $activeManualPaymentMethods->pluck('id')->toArray()) ? TRUE : FALSE;
                    // $temp = $activeManualPaymentMethods->where('id', $payment_provider->id)->first();
                    // $info = $temp ? $temp->pivot->additional_details : '';
                    break;

                default:
                  $has_config = FALSE;
                  break;
            }

            if( ! $has_config )
                $paymentMethods->forget($key);
        }


        return PaymentMethodResource::collection($paymentMethods);
    }

    /**
     * Return available shipping options for the specified shop.
     *
     * @param  str  $shop
     * @return \Illuminate\Http\Response
     */
    public function shipping($shop)
    {
        $shop = Shop::where('slug', $shop)->active()->firstOrFail();
        return PackagingResource::collection($shop->activePackagings);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function countries()
    {
        $countries = Country::select('id','name','iso_3166_2','iso_3166_3')->get();
        return CountryResource::collection($countries);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $country
     * @return \Illuminate\Http\Response
     */
    public function states($country)
    {
        $states = State::select('id','name','iso_3166_2')->where('country_id', $country)->get();
        return StateResource::collection($states);
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return new PageResource($page);
    }
}
