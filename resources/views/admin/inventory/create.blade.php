@extends('admin.layouts.master')

@section('content')
    {!! Form::open(['route' => 'admin.stock.inventory.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}

        @include('admin.inventory._form')

    {!! Form::close() !!}
@endsection

@section('page-script')
    @include('plugins.dropzone-upload')
    @include('plugins.dynamic-inputs')
@endsection