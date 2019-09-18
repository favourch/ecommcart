@extends('installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.classic.title') }}
@endsection

@section('container')
    @if($license_notifications_array['notification_case'] == "notification_license_ok")
        <div class="alert alert-warning"><i class="fa fa-info-circle"></i> {{ trans('installer_messages.verified') }}</div>

        <div class="buttons">
            <a class="button" href="{{ route('Installer.database') }}" onclick="changeText()">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.finish') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @else
        <div class="alert alert-danger">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ trans('installer_messages.verification_failed') }}
        </div>
    @endif
@endsection