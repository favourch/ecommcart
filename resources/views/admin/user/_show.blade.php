<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
			<div class="card hovercard">
			    <div class="card-background">
					<img src="{{ get_storage_file_url(optional($user->image)->path, 'small') }}" class="card-bkimg img-circle" alt="{{ trans('app.avatar') }}">
			    </div>
			    <div class="useravatar">
		            @if($user->image)
						<img src="{{ get_storage_file_url(optional($user->image)->path, 'small') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
		            @else
	            		<img src="{{ get_gravatar_url($user->email, 'small') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
		            @endif
			    </div>
			    <div class="card-info">
			        <span class="card-title">{{ $user->getName() }}</span>
			    </div>
			</div>

			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#tab_1" data-toggle="tab">
				  	{{ trans('app.basic_info') }}
				  </a></li>
				  <li><a href="#tab_2" data-toggle="tab">
				  	{{ trans('app.description') }}
				  </a></li>
				  <li><a href="#tab_3" data-toggle="tab">
				  	{{ trans('app.contact') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="tab_1">
				        <table class="table">
				            @if($user->name)
				                <tr>
				                	<th>{{ trans('app.full_name') }}: </th>
				                	<td>{{ $user->name }}</td>
				                </tr>
				            @endif
				            @if($user->shop)
				                <tr>
				                	<th>{{ trans('app.shop') }}: </th>
				                	<td>{{ $user->shop->name }}</td>
				                </tr>
				            @endif
			                <tr>
			                	<th>{{ trans('app.roles') }}: </th>
			                	<td>
						          	<span class="label label-outline">{{ $user->role->name }}</span>
				                </td>
			               	</tr>
				            @if($user->dob)
				                <tr>
				                	<th>{{ trans('app.dob') }}: </th>
				                	<td>{!! date('F j, Y', strtotime($user->dob)) . '<small> (' . get_age($user->dob) . ')</small>' !!}</td>
				                </tr>
				            @endif
				            @if($user->sex)
				                <tr>
				                	<th>{{ trans('app.sex') }}: </th>
				                	<td>{!! get_formated_gender($user->sex) !!}</td>
				                </tr>
				            @endif
			                <tr>
			                	<th>{{ trans('app.status') }}: </th>
			                	<td>{{ ($user->active) ? trans('app.active') : 	trans('app.inactive') }}</td>
			                </tr>
				            @if($user->created_at)
				                <tr>
				                	<th>{{ trans('app.member_since') }}: </th>
				                	<td>{{ $user->created_at->diffForHumans() }}</td>
				                </tr>
				            @endif
				        </table>
				    </div> <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_2">
			            {!! $user->description ?? trans('app.info_not_found') !!}
				    </div> <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_3">
				        <table class="table">
							<tr>
								<th class="text-right">{{ trans('app.email') }}:</th>
								<td style="width: 75%;">{{ $user->email }}</td>
							</tr>
				            @if($user->primaryAddress)
							<tr>
								<th class="text-right">{{ trans('app.address') }}:</th>
								<td style="width: 75%;">
				        			{!! $user->primaryAddress->toHtml() !!}
								</td>
							</tr>
							@endif
				        </table>

	            		@if(config('system_settings.address_show_map'))
					        <div class="row">
			                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ urlencode(optional($user->primaryAddress)->toGeocodeString()) }}&output=embed"></iframe>
					        </div>
					        <div class="help-block" style="margin-bottom: -10px;"><i class="fa fa-warning"></i> {{ trans('app.map_location') }}</div>
				       	@endif
				    </div> <!-- /.tab-pane -->
				</div> <!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->