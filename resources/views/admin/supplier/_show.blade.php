<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-3 nopadding" style="margin-top: 10px;">
				<img src="{{ get_storage_file_url(optional($supplier->image)->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.logo') }}">
			</div>
            <div class="col-md-9 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 75%;">{{ $supplier->name }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.contact_person') }}:</th>
						<td style="width: 75%;">{{ $supplier->contact_person }}</td>
					</tr>
		            <tr>
		            	<th class="text-right">{{ trans('app.status') }}: </th>
		            	<td style="width: 75%;">{{ ($supplier->active) ? trans('app.active') : trans('app.inactive') }}</td>
		            </tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $supplier->created_at->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $supplier->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>

			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active">
				  	<a href="#tab_1" data-toggle="tab">
						{{ trans('app.description') }}
				  	</a>
				  </li>
				  <li>
				  	<a href="#tab_2" data-toggle="tab">
						{{ trans('app.contact') }}
				  	</a>
				  </li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="tab_1">
					  <div class="box-body">
			            {!! $supplier->description ?? trans('app.description_not_available') !!}
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_2">
				        <table class="table">
				            @if($supplier->contact_person)
								<tr>
									<th class="text-right">{{ trans('app.contact_person') }}:</th>
									<td style="width: 75%;">{{ $supplier->contact_person }}</td>
								</tr>
							@endif
				            @if($supplier->email)
								<tr>
									<th class="text-right">{{ trans('app.email') }}:</th>
									<td style="width: 75%;">{{ $supplier->email }}</td>
								</tr>
							@endif
				            @if($supplier->primaryAddress)
								<tr>
									<th class="text-right">{{ trans('app.address') }}:</th>
									<td style="width: 75%;">
					        			{!! $supplier->primaryAddress->toHtml() !!}
									</td>
								</tr>
							@endif
				        </table>
				    </div>
				    <!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->