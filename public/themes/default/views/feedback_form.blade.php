@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.order_detail')

    <!-- CONTENT SECTION -->
	@include('contents.leave_feedback')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')
@endsection