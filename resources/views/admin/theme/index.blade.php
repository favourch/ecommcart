@extends('admin.layouts.master')

@section('content')
	<div class="box">
		@php
			$active_theme = $storeFrontThemes->firstWhere('slug', active_theme());

			$storeFrontThemes = $storeFrontThemes->filter(function ($value, $key) {
			    return $value['slug'] != active_theme();
			});
		@endphp
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#storeFrontThemes_tab" data-toggle="tab">
					<i class="fa fa-paint-brush hidden-sm"></i>
					{{ trans('app.storefront_themes') }}
				</a></li>
				<li><a href="#sellingThemes_tab" data-toggle="tab">
					<i class="fa fa-handshake-o hidden-sm"></i>
					{{ trans('app.selling_themes') }}
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane active" id="storeFrontThemes_tab">
			    	<div class="row themes">
				  		<div class="theme col-sm-6 col-md-4">
						    <div class="thumbnail active">
								<img src="{{ theme_asset_url('screenshot.png') }}" alt="" scale="0">
								<div class="caption">
									<p class="lead">{{ $active_theme['name'] }} <small class="pull-right">v-{{ $active_theme['version'] }}</small></p>
									<p>{{ $active_theme['description'] }}</p>
									<p><button class="btn btn-success" disabled>{{ trans('app.current_theme') }}</button></p>
								</div>
						    </div>
				  		</div>

				    	@foreach($storeFrontThemes as $theme)
					  		<div class="theme col-sm-6 col-md-4 nopadding-left">
							    <div class="thumbnail">
									<img src="{{ theme_asset_url('screenshot.png', $theme['slug']) }}" alt="" scale="0">
									<div class="caption">
										<p class="lead">{{ $theme['name'] }} <small class="pull-right">v-{{ $theme['version'] }}</small></p>
										<p>{{ $theme['description'] }}</p>
								    	{!! Form::open(['route' => ['admin.appearance.theme.activate', $theme['slug']], 'method' => 'PUT']) !!}
								            {!! Form::submit(trans('app.activate'), ['class' => 'confirm btn btn-flat btn-default']) !!}
								        {!! Form::close() !!}
									</div>
							    </div>
					  		</div>
				    	@endforeach
			    	</div>
			    </div>

			    <div class="tab-pane" id="sellingThemes_tab">
					<div class="row themes">
			    		@foreach($sellingThemes as $theme)
					  		<div class="theme col-sm-6 col-md-4">
							    <div class="thumbnail {{ $theme['slug'] == active_selling_theme() ? 'active' : '' }}">
									<img src="{{ selling_theme_asset_url('screenshot.png', $theme['slug']) }}" alt="" scale="0">
									<div class="caption">
										<p class="lead">{{ $theme['name'] }} <small class="pull-right">v-{{ $theme['version'] }}</small></p>
										<p>{{ $theme['description'] }}</p>
										@if($theme['slug'] == active_selling_theme())
											<p><button class="btn btn-success" disabled>{{ trans('app.current_theme') }}</button></p>
										@else
									    	{!! Form::open(['route' => ['admin.appearance.theme.activate', $theme['slug'], 'selling'], 'method' => 'PUT']) !!}
									            {!! Form::submit(trans('app.activate'), ['class' => 'confirm btn btn-flat btn-default']) !!}
									        {!! Form::close() !!}
										@endif
									</div>
							    </div>
					  		</div>
			    		@endforeach
					</div>
			    </div>
			</div>
			<!-- /.tab-content -->
		</div>
		<!-- /.nav-tabs-custom -->
	</div> <!-- /.box -->

	<div class="panel panel-success">
		<div class="panel-heading">
			<i class="fa fa-rocket"></i>
			Looking for more personalized theme?
		</div>
		<div class="panel-body">
			Send us an email for any kind of modification or custom work as we know the code better than everyone.
		</div>
	</div>
@endsection
