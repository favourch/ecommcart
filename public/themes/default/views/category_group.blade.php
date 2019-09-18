@extends('layouts.main')

@section('content')
    <!-- CATEGORY COVER IMAGE -->
    {{-- @include('banners.category_cover', ['category' => $category]) --}}

    <!-- HEADER SECTION -->
    @include('headers.category_group_page', ['category' => $categoryGroup])

    <!-- CONTENT SECTION -->
    @include('contents.category_page')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')

    <!-- bottom Banner -->
    @include('banners.bottom')
@endsection