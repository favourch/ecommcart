<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::open(['route' => ['admin.stock.inventory.addWithVariant', $product_id], 'method' => 'get', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.set_variants') }}
        </div>
        <div class="modal-body">
            @foreach($attributes as $attribute)
                <div class="form-group">
                    {!! Form::label($attribute->name, $attribute->name, ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.set_attribute') }}"></i>
                    <select class="form-control select2-set_attribute" id="{{ $attribute->name }}" name="{{ $attribute->id }}[]" multiple='multiple' placeholder="{{ trans('app.placeholder.attribute_values') }}">
                        @foreach($attribute->attributeValues as $attributeValue)
                            <option value="{{ $attributeValue->id }}">{{ $attributeValue->value }}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.set_variants'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->