@extends('layouts.main')

@section('content')
    <!-- CATEGORY COVER IMAGE -->
    @include('banners.category_cover', ['category' => $category])

    <!-- HEADER SECTION -->
    @include('headers.category_page', ['category' => $category])

    <!-- CONTENT SECTION -->
    @include('contents.category_page')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- bottom Banner -->
    @include('banners.bottom')
@endsection