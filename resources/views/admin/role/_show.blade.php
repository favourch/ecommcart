<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding-top: 15px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-12 nopadding" style="margin-top: 10px;">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.role') }}:</th>
						<td style="width: 75%;"><span class="lead">{{ $role->name }}</span></td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.description') }}:</th>
						<td style="width: 75%;">{!! $role->description !!}</td>
					</tr>
		            <tr>
		            	<th class="text-right">{{ trans('app.type') }}: </th>
		            	<td style="width: 75%;">{{ ($role->public) ? trans('app.merchant') : trans('app.platform') }}</td>
		            </tr>
					<tr>
						<th class="text-right">{{ trans('app.role_level') }}:</th>
						<td style="width: 75%;"><span class="label label-default">{{ $role->level ?? trans('app.not_set') }}</span></td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $role->created_at->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $role->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>

			<div class="clearfix"></div>

            <div class="row">
	            <div class="box-body">
					@if($role_permissions)
					    <table class="table table-striped">
							<thead>
								<tr>
								  <th width="40%" class="text-center">
								    {{ strtoupper(trans('app.modules')) }}
								  </th>
								  <th>
								    {{ strtoupper(trans('app.form.permissions')) }}
								  </th>
								</tr>
							</thead>
					    	<tbody>
				        		@foreach($modules as $module)
									@if(in_array($module->id, $role_permissions))
										<tr>
											<td><button class="btn btn-primary btn-lg btn-block disabled" style="cursor: default;">{{ $module->name }}</button></td>
											<td>
									        @foreach($module->permissions as $permission)
									        	@if(array_key_exists($permission->slug, $role_permissions))
													<span class="label label-outline">
													<i class="fa fa-check"></i>
													{{ $permission->name }}</span>
												@else
													<span class="label label-danger">
													<i class="fa fa-times"></i>
													{{ $permission->name }}</span>
												@endif
					 						@endforeach
											</td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-danger">{{ trans('app.no_permissions_set') }}</div>
					@endif
		        </div>
	        </div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->