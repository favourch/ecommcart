<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.email_template_name') }}"></i>
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.template_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-3 nopadding">
    <div class="form-group">
      {!! Form::label('type', trans('app.form.email_template_type').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.email_template_type') }}"></i>
      {!! Form::select('type', ['HTML' => trans('app.html'), 'Text' => trans('app.text')], null, ['class' => 'form-control select2-normal', 'id' => 'send_email', 'placeholder' => trans('app.placeholder.template_type'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-3 nopadding-left">
    <div class="form-group">
      {!! Form::label('template_for', trans('app.form.template_for').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.template_use_for') }}"></i>
      {!! Form::select('template_for', ['Platform' => trans('app.platform'), 'Merchant' => trans('app.merchant')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.template_type'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('sender_email', trans('app.form.template_sender_email').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.template_sender_email') }}"></i>
      {!! Form::email('sender_email', isset($template->sender_email) ? $template->sender_email : config('shop_settings.default_sender_email_address'), ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('sender_name', trans('app.form.template_sender_name').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.template_sender_name') }}"></i>
      {!! Form::text('sender_name', isset($template->sender_name) ? $template->sender_name : config('shop_settings.default_email_sender_name'), ['class' => 'form-control', 'placeholder' => trans('app.placeholder.template_sender_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('subject', trans('app.form.subject').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.email_template_subject') }}"></i>
  {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.template_subject'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
  {!! Form::label('body', trans('app.form.template_body').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.email_template_body') }}"></i>
  {!! Form::textarea('body', null, ['class' => 'form-control summernote-long', 'placeholder' => trans('app.placeholder.template_body'), 'required']) !!}
</div>

<div class="box collapsed-box">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-code"></i> {{ trans('app.short_codes') }}</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div> <!-- /.box-header -->
  <div class="box-body">
    @include('admin.email-template._short_codes')
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>
