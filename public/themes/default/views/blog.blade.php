@extends('layouts.main')

@section('content')
    <!-- Blog COVER IMAGE -->
    @include('banners.blog_cover')

    <!-- CONTENT SECTION -->

    @includeWhen(isset($blogs), 'contents.blog_page')

    @includeWhen(isset($blog), 'contents.blog_single')
@endsection