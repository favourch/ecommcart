<div class="modal-dialog modal-xs">
    <div class="modal-content">
        {!! Form::model($inventory, ['method' => 'PUT', 'route' => ['admin.stock.inventory.updateQtt', $inventory->id], 'class' => 'ajax-form', 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.update') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label('stock_quantity', trans('app.form.stock_quantity').'*') !!}
                {!! Form::number('stock_quantity' , null, ['id' => 'stock_quantity', 'class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->

<script type="text/javascript">
    $('#stock_quantity').on('change', function(e){
        var qttNote = '.qtt-' + {{ Request::route('inventory') }};

        $(qttNote).text($(this).val());
    });
</script>