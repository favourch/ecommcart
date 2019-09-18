<div class="modal-dialog modal-sm">
    <div class="modal-content">
        {!! Form::model($shipping_zone, ['method' => 'PUT', 'route' => ['admin.shipping.shippingZone.updateStates', $shipping_zone->id, $country], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.states') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              <div class="input-group input-group-lg">
                <span class="input-group-addon no-border"> <i class="fa fa-search text-muted"></i> </span>
                {!! Form::text('', null, ['id' => 'search_this', 'class' => 'form-control no-border', 'placeholder' => trans('app.placeholder.search')]) !!}
              </div>
            </div>

            @php
                $states = get_states_of($country);
            @endphp
            <table class="table table-striped" id="search_table">
                <tbody>
                    @foreach($states as $state_id => $state_name)
                        <tr>
                            <td>
                                {!! Form::checkbox('states[]', $state_id, in_array($state_id, $shipping_zone->state_ids), ['id' => $state_id, 'class' => 'icheckbox_line']) !!}
                                {!! Form::label($state_name, strtoupper($state_name), ['class' => 'indent5']) !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->