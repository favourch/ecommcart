<fieldset>
  <legend>{{ trans('app.form.key_features') }}
      <button id="AddMoreField" class="btn btn-xs btn-new" data-toggle="tooltip" data-title="{{ trans('help.add_input_field') }}"><i class="fa fa-plus"></i></button>
  </legend>
  <div id="DynamicInputsWrapper">
    @if(isset($inventory))
      @foreach(unserialize($inventory->key_features) as $key_feature)
        <div class="form-group">
          <div class="input-group">
            {!! Form::text('key_features[]', $key_feature, ['class' => 'form-control input-sm', 'placeholder' => trans('app.placeholder.key_feature')]) !!}
            <span class="input-group-addon">
              <i class="fa fa-times removeThisInputBox" data-toggle="tooltip" data-title="{{ trans('help.remove_input_field') }}"></i>
            </span>
          </div>
        </div>
      @endforeach
    @else
      <div class="form-group">
        <div class="input-group">
          {!! Form::text('key_features[]', null, ['id' => 'field_1', 'class' => 'form-control input-sm', 'placeholder' => trans('app.placeholder.key_feature')]) !!}
          <span class="input-group-addon">
            <i class="fa fa-times removeThisInputBox" data-toggle="tooltip" data-title="{{ trans('help.remove_input_field') }}"></i>
          </span>
        </div>
      </div>
    @endif
  </div>
</fieldset>

<div class="form-group">
  {!! Form::label('description', trans('app.form.description'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_description') }}"></i>
  {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.description')]) !!}
</div>