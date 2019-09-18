@extends('auth.master')

@section('content')
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="box login-box-body">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.form.password_reset') }}</h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
      {!! Form::open(['route' => 'password.email', 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="form-group has-feedback">
          {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          <div class="help-block with-errors"></div>
        </div>

        {!! Form::submit(trans('app.form.send_password_link'), ['class' => 'btn btn-block btn-lg btn-flat btn-primary']) !!}
      {!! Form::close() !!}
      <a href="{{ route('login') }}" class="btn btn-link">{{ trans('app.login') }}</a>
    </div>
  </div>
@endsection