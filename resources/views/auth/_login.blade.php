<div class="modal-dialog modal-xs">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                        <div class="form-group has-feedback">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <div class="modal-footer">
            @if(env('APP_DEMO') == TRUE)
                <h4>Demo Login::</h4>
                <p><strong>ADMIN::</strong> Username: <strong>superadmin@demo.com</strong> | Password: <strong>123456</strong> </p>
                <p><strong>MERCHANT::</strong> Username: <strong>merchant@demo.com</strong> | Password: <strong>123456</strong> </p>
            @endif
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->