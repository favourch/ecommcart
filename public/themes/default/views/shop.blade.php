@extends('layouts.main')

@section('content')
    <!-- SHOP COVER IMAGE -->
    @include('banners.shop_cover', ['shop' => $shop])

    <!-- CONTENT SECTION -->
    @include('contents.shop_page')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- MODALS -->
    @include('modals.shopReviews')
@endsection