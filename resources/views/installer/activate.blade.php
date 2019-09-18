@extends('installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.verify.verify_purchase') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.verify.verify_purchase') }}
@endsection

@section('container')

    @if(session()->has('failed'))
        <div class="alert alert-danger">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ session()->get('failed') }}
        </div>
    @endif

    {{-- <div class="alert alert-warning"><i class="fa fa-info-circle"></i> {!! trans('installer_messages.environment.classic.backup') !!}</div> --}}
    <form method="post" action="{{ route('Installer.verify') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email_address"> {{ trans('installer_messages.verify.form.email_address_label') }} </label>
            <input type="text" name="email_address" id="email_address" value="{{ old('email_address') }}" placeholder="{{ trans('installer_messages.verify.form.email_address_placeholder') }}" required />
        </div>

        <div class="form-group">
            <label for="purchase_code"> {{ trans('installer_messages.verify.form.purchase_code_label') }} </label>
            <input type="text" name="purchase_code" id="purchase_code" value="{{ old('purchase_code') }}" placeholder="{{ trans('installer_messages.verify.form.purchase_code_placeholder') }}" required />
        </div>

        <div class="form-group">
            <label for="root_url"> {{ trans('installer_messages.verify.form.root_url_label') }} </label>
            <input type="text" name="root_url" id="root_url" value="{{ rtrim(env('APP_URL'), '/') }}" placeholder="{{ trans('installer_messages.verify.form.root_url_placeholder') }}" required />
        </div>

        <div class="buttons">
            <button class="button" type="submit">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.verify.submit') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </button>

            {{-- <a class="button" href="{{ route('Installer.database') }}" onclick="changeText()">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.install') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a> --}}
        </div>
    </form>

    @if( isset($environment['errors']))
{{--         <div class="buttons">
            <a class="button" href="{{ route('Installer.database') }}" onclick="changeText()">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.environment.classic.install') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @else --}}
        <div class="alert alert-danger">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ trans('installer_messages.environment.classic.required') }}
        </div>
    @endif

@endsection