@extends('layouts.main')

@section('content')
    <!-- BRAND COVER IMAGE -->
    @include('banners.brand_cover', ['brand' => $brand])

    <!-- CONTENT SECTION -->
    @include('contents.brand_page')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')
@endsection