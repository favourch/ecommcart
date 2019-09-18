<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-12 nopadding" style="margin-top: 10px;">
 	  			@if($attributeValue->image)
					<img src="{{ get_storage_file_url($attributeValue->image->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.image') }}">
				@elseif($attributeValue->color)
					<div class="jumbotron" style="background-color: {{ $attributeValue->color }}">
						<h3 class="text-center" style="color: #d3d3d3; font-weight: lighter;">{{ strtoupper($attributeValue->color) }}</h3>
					</div>
				@endif
			</div>
            <div class="col-md-12 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.attribute_type') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->attribute->attributeType->type }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.attribute') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->attribute->name }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.value') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->value }}</td>
					</tr>
		            @if($attributeValue->color)
					<tr>
						<th class="text-right">{{ trans('app.color') }}:</th>
						<td style="width: 75%;">
							<i class="fa fa-square" style="color: {{ $attributeValue->color }}"></i>
							{{ $attributeValue->color }}
						</td>
					</tr>
					@endif
					<tr>
						<th class="text-right">{{ trans('app.position') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->order }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->created_at->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $attributeValue->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->