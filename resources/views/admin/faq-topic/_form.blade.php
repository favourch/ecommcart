<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.topic_name').'*') !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('for', trans('app.form.topic_for').'*') !!}
      {!! Form::select('for', $topics, isset($faqTopic) ? Null : 1, ['class' => 'form-control select2-normal', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>