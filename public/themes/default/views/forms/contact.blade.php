<div class="section-title">
  <h4>@lang('theme.section_headings.contact_form')</h4>
</div>

{!! Form::open(['route' => 'contact_us', 'id' => 'contact_us_form', 'role' => 'form', 'data-toggle' => 'validator']) !!}
  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.name'), 'maxlength' => '100', 'required']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
    <div class="col-md-6 nopadding-left">
      <div class="form-group">
        {!! Form::email('email', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.email'), 'maxlength' => '100', 'required']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>

  <div class="form-group">
    {!! Form::text('subject', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.contact_us_subject'), 'maxlength' => 200, 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    {!! Form::textarea('message', null, ['class' => 'form-control input-lg flat', 'placeholder' => trans('theme.placeholder.message'), 'rows' => 3, 'maxlength' => 500, 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>

  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group">
        <button type="submit" class='btn btn-primary btn-lg flat'><i class="fa fa-paper-plane"></i> {{ trans('theme.button.send_message') }}</button>
      </div>
    </div>
    <div class="col-md-6 nopadding-left">
      <div class="form-group">
        @if(env('GOOGLE_RECAPTCHA_KEY'))
          <div class="g-recaptcha"
              data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
          </div>
        @endif
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
{!! Form::close() !!}

<script src='https://www.google.com/recaptcha/api.js'></script>