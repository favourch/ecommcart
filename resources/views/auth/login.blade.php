@extends('auth.master')

@section('content')
    <div class="box login-box-body">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.form.login') }}</h3>
        </div> <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['route' => 'login', 'id' => 'form', 'data-toggle' => 'validator']) !!}
                <div class="form-group has-feedback">
                    {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.form.email_address'), 'required']) !!}
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group has-feedback">
                    {!! Form::password('password', ['class' => 'form-control input-lg', 'id' => 'password', 'placeholder' => trans('app.form.password'), 'data-minlength' => '6', 'required']) !!}
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="row">
                    <div class="col-xs-7">
                        <div class="form-group">
                            <label>
                                {!! Form::checkbox('remember', null, null, ['class' => 'icheck']) !!} {{ trans('app.form.remember_me') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        {!! Form::submit(trans('app.form.login'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>

        <a class="btn btn-link" href="{{ route('password.request') }}">{{ trans('app.form.forgot_password') }}</a>
        <a class="btn btn-link" href="{{ route('register') }}" class="text-center">{{ trans('app.form.register_as_merchant') }}</a>
    </div>

    @if(env('APP_DEMO') == TRUE)
        <div class="box login-box-body">
            <div class="box-header with-border">
              <h3 class="box-title">Demo Login::</h3>
            </div> <!-- /.box-header -->
            <div class="box-body">
                <p><strong>ADMIN::</strong> Username: <strong>superadmin@demo.com</strong> | Password: <strong>123456</strong> </p>
                <p><strong>MERCHANT::</strong> Username: <strong>merchant@demo.com</strong> | Password: <strong>123456</strong> </p>
            </div>
        </div>
    @endif
@endsection