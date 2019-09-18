@extends('layouts.main')

@section('content')
    <!-- CATEGORY COVER IMAGE -->
    {{-- @include('banners.category_cover', ['category' => $category]) --}}

    <!-- CONTENT SECTION -->
    @include('contents.gift_card_shop')
@endsection