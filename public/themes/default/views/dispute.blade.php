@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.dispute_page')

    <!-- CONTENT SECTION -->
	@include('contents.dispute_page')

    <!-- MODALS -->
	@includeWhen( ! $order->dispute, 'modals.dispute')

    @if($order->dispute->isClosed())
	    @include('modals.dispute_appeal')
    @else
	    @include('modals.dispute_response')
    @endif
@endsection