@extends('installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')
	{{--
	@if(session('message')['dbOutputLog'])
		<p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
		<pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
	@endif --}}

	{{-- <p><strong><small>{{ trans('installer_messages.final.console') }}</small></strong></p>
	<pre><code>{{ $finalMessages }}</code></pre> --}}

	{{-- <p><strong><small>{{ trans('installer_messages.final.log') }}</small></strong></p> --}}
	{{-- <code>{{ $finalStatusMessage }}</code> --}}

	{{-- <p><strong><small>{{ trans('installer_messages.final.env') }}</small></strong></p> --}}
	{{-- <pre><code>{{ $finalEnvFile }}</code></pre> --}}

	<br/><br/>

    <div class="buttons">
        <a href="{{ route('Installer.seedDemo') }}" class="button" onclick="btnBusy(event)" style="background-color: transparent; color: #1d73a2; border: 1px solid #1d73a2;" >
         	{!! trans('installer_messages.final.import_demo_data') !!}
            <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
        </a>

        <a href="{{ route('Installer.finish') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
    </div>

@endsection
