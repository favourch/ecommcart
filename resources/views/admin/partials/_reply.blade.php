<div class="form-group">
  {!! Form::label('reply', trans('app.form.message').'*') !!}
  {!! Form::textarea('reply', Null, ['class' => 'form-control summernote', 'rows' => '2', 'placeholder' => trans('app.placeholder.reply'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

@include('admin.partials._attachment_upload_field')