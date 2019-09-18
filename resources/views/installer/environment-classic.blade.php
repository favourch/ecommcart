@extends('installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.classic.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> {{ trans('installer_messages.environment.classic.title') }}
@endsection

@section('container')

    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> {!! trans('installer_messages.environment.classic.backup') !!}</div>
    <form method="post" action="{{ route('Installer.environmentSaveClassic') }}">
        {!! csrf_field() !!}

        <textarea class="textarea" name="envConfig" style="background-color: #2b303b; color: #c0c5ce">{{ $envConfig }}</textarea>

        <div class="buttons buttons--right">
            <button class="button button--light" type="submit" onclick="btnBusy(event)">
            	<i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
             	{!! trans('installer_messages.environment.classic.save') !!}
            </button>
        </div>
    </form>

    @if( ! isset($environment['errors']))
        <div class="buttons">
            <a class="button" href="{{ route('Installer.activate') }}" onclick="changeText()">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                {!! trans('installer_messages.verify.verify_purchase') !!}
                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @else
        <div class="alert alert-danger">
            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
            {{ trans('installer_messages.environment.classic.required') }}
        </div>
    @endif

@endsection