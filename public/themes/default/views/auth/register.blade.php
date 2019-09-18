@extends('auth.layout')

@section('content')
    <div class="box login-box-body">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('theme.register') }}</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['route' => 'customer.register', 'id' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="form-group has-feedback">
                    {!! Form::text('name', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.full_name'), 'required']) !!}
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.valid_email'), 'required']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password_confirmation', ['class' => 'form-control input-lg', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>
                @if(config('system_settings.ask_customer_for_email_subscription'))
                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('subscribe', null, null, ['class' => 'icheck']) !!} {!! trans('theme.input_label.subscribe_to_the_newsletter') !!}
                        </label>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xs-7">
                        <div class="form-group">
                            <label>
                                {!! Form::checkbox('agree', null, null, ['class' => 'icheck', 'required']) !!} {!! trans('theme.input_label.i_agree_with_terms') !!}
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        {!! Form::submit(trans('theme.register'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}

            <div class="social-auth-links text-center">
                <a href="{{ route('customer.login.social', 'facebook') }}" class="btn btn-block btn-social btn-facebook btn-lg btn-flat"><i class="fa fa-facebook"></i> {{ trans('theme.button.login_with_fb') }}</a>
                <a href="{{ route('customer.login.social', 'google') }}" class="btn btn-block btn-social btn-google btn-lg btn-flat"><i class="fa fa-google"></i> {{ trans('theme.button.login_with_g') }}</a>
            </div>

            <a href="{{ route('customer.login') }}" class="btn btn-link">{{ trans('theme.have_an_account') }}</a>
        </div>
    </div>
@endsection