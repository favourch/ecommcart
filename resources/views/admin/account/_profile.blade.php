<div class="row">
  	<div class="col-md-3">
		<div class="form-group">
		  	<label>{{ trans('app.form.avatar') }}</label>
			<img src="{{ get_storage_file_url(optional($profile->image)->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.avatar') }}">
		  	@if($profile->image)
				<a class="btn btn-xs btn-default confirm ajax-silent" type="submit" href="{{ route('admin.account.deletePhoto') }}"><i class="fa fa-trash-o"></i> {{ trans('app.form.delete_avatar') }}</a>
		  	@endif
		</div>

		<div class="form-group">
    		{!! Form::open(['route' => 'admin.account.updatePhoto', 'files' => true, 'data-toggle' => 'validator']) !!}
				<div class="row">
				    <div class="col-md-8 nopadding-right">
			          <input type="file" name="image" required />
				      <div class="help-block with-errors"></div>
			        </div>
				    <div class="col-md-4 nopadding-left">
				        <button type="submit" class="btn btn-info btn-block">{{ trans('app.form.upload') }}</button>
		    		</div>
				</div>
			{!! Form::close() !!}
	    </div>
  	</div>

  	<div class="col-md-6">
        {!! Form::model($profile, ['method' => 'PUT', 'route' => ['admin.account.update'], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}

		    <div class="form-group">
		      {!! Form::label('name', trans('app.form.full_name').'*') !!}
		      {!! Form::text('name', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.full_name'), 'required']) !!}
		      <div class="help-block with-errors"></div>
		    </div>
		    <div class="form-group">
		      {!! Form::label('nice_name', trans('app.form.nice_name') ) !!}
		      {!! Form::text('nice_name', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.nice_name')]) !!}
		    </div>
		    <div class="form-group">
		      {!! Form::label('role', trans('app.form.role')) !!}
		      {!! Form::text('role', $profile->role->name, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
		    </div>
		    <div class="form-group">
		      {!! Form::label('email', trans('app.form.email_address').'*' ) !!}
		      {!! Form::email('email', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
		      <div class="help-block with-errors"></div>
		    </div>

		    <div class="form-group">
		      {!! Form::label('dob', trans('app.form.dob')) !!}
		      <div class="input-group">
		        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		        {!! Form::text('dob', Null, ['class' => 'form-control datepicker', 'placeholder' => trans('app.placeholder.dob')]) !!}
		      </div>
		    </div>
		    <div class="form-group">
		      {!! Form::label('sex', trans('app.form.sex')) !!}
		      {!! Form::select('sex', ['app.male' => trans('app.male'), 'app.female' => trans('app.female'), 'app.other' => trans('app.other')], null, ['class' => 'form-control select2-normal', 'placeholder' =>trans('app.placeholder.sex')]) !!}
		    </div>

			<div class="form-group">
			  {!! Form::label('description', trans('app.form.biography')) !!}
			  {!! Form::textarea('description', Null, ['class' => 'form-control summernote-without-toolbar', 'rows' => '2', 'placeholder' => trans('app.placeholder.biography')]) !!}
			</div>

            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        {!! Form::close() !!}
  	</div>

  	<div class="col-md-3">
		<div class="form-group">
		  	<label>{{ trans('app.form.address') }}</label>
			@if($profile->primaryAddress)

    			{!! $profile->primaryAddress->toHtml() !!}

				<a class="ajax-modal-btn btn btn-default" href="#" data-link="{{ route('address.edit', $profile->primaryAddress->id) }}"><i class="fa fa-map-marker"></i> {{ trans('app.update_address') }}</a>
			@else
				<a class="ajax-modal-btn btn btn-default" href="#" data-link="{{ route('address.create', ['user', $profile->id]) }}"><i class="fa fa-plus-square-o"></i> {{ trans('app.add_address') }}</a>
			@endif
	  	</div>

		<div class="form-group">
			<a class="ajax-modal-btn btn btn-default" href="#" data-link="{{ route('admin.account.showChangePasswordForm') }}"><i class="fa fa-lock"></i> {{ trans('app.change_password') }}</a>
		</div>

	    @if($profile->merchantId())
		    <hr/>
			<div class="form-group">
			  	<label>{{ trans('app.merchant') }}</label>
			  	<p class="lead">{{ optional($profile->shop)->name }}</p>

			  	<label>{{ trans('app.form.logo') }}</label>
		        <img src="{{ get_storage_file_url(optional($profile->shop->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.logo') }}">
		  	</div>
	    @endif
  	</div>
</div>
