<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#account-info-tab" aria-controls="account-info-tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('theme.basic_info')</a>
    </li>
    <li role="presentation" class="">
      <a href="#password-tab" aria-controls="password-tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.change_password')</a>
    </li>
    <li role="presentation" class="">
      <a href="#address-tab" aria-controls="address-tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.addresses')</a>
    </li>
  </ul><!-- /.nav-tab -->

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="account-info-tab">
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            {!! Form::model($account, ['method' => 'PUT', 'route' => 'account.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
              <div class="form-group">
                {!! Form::label('name', trans('theme.full_name').'*', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                  {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.full_name'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('nice_name', trans('theme.nice_name'), ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                  {!! Form::text('nice_name', null, ['id' => 'nice_name', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.nice_name')]) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('email', trans('theme.email').'*', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                  {!! Form::email('email', null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.email'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('dob', trans('theme.dob'), ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                  <div class="input-group">
                    {!! Form::text('dob', null, ['class' => 'form-control flat datepicker', 'placeholder' => trans('theme.placeholder.dob')]) !!}
                    <span class="input-group-addon flat"><i class="fa fa-calendar"></i></span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('description', trans('theme.bio'), ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-sm-8">
                  {!! Form::textarea('description', null, ['class' => 'form-control flat', 'rows' => '4', 'placeholder' => trans('theme.placeholder.bio')]) !!}
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small>
                </div>
                <div class="col-sm-8">
                  {!! Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat']) !!}
                </div>
              </div>
            {!! Form::close() !!}
          </div><!-- /.row -->
        </div><!-- /.col-md-8 -->

        <div class="col-md-4">
            <div class="text-center">
              <div class="form-group">
                @if($account->image)
                  {!! Form::model($account, ['method' => 'DELETE', 'route' => 'my.avatar.remove', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
                      <button class="btn btn-xs btn-default confirm pull-right flat" data-confirm="@lang('theme.confirm_action.delete')" type="submit" data-toggle="tooltip" data-title="{{ trans('theme.button.delete') }}" data-placement="left"><i class="fa fa-trash-o"></i></button>
                  {!! Form::close() !!}
                @endif

                {!! Form::label('avatar', trans('theme.avatar')) !!}
                <img src="{{ get_storage_file_url(optional($account->image)->path, 'medium') }}" class="thumbnail center-block" alt="{{ trans('theme.avatar') }}"/>
              </div>

              {!! Form::open(['route' => 'my.avatar.save', 'files' => true, 'data-toggle' => 'validator']) !!}
                  <div class="form-group">
                    {!! Form::file('avatar',['class' => '', 'required']) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                  <button type="submit" class="btn btn-default btn-sm flat">{{ trans('theme.button.change_avatar') }}</button>
              {!! Form::close() !!}
            </div>
        </div><!-- /col-md-4 -->
      </div>
    </div><!-- /#account-info-tab -->

    <div role="tabpanel" class="tab-pane fade" id="password-tab">
      <div class="row">
        <div class="col-md-8 col-sm-offset-1">
          <div class="row">
            {!! Form::model($account, ['method' => 'PUT', 'route' => 'my.password.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
              @if($account->password)
                <div class="form-group">
                  {!! Form::label('current_password', trans('theme.current_password').'*', ['class' => 'col-sm-4 control-label']) !!}
                  <div class="col-sm-8">
                    {!! Form::password('current_password', ['class' => 'form-control flat', 'id' => 'current_password', 'placeholder' => trans('theme.placeholder.current_password'), 'data-minlength' => '6', 'required']) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              @endif

              <div class="form-group">
                {!! Form::label('password', trans('theme.new_password').'*', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-md-8">
                  {!! Form::password('password', ['class' => 'form-control flat', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('password_confirmation', trans('theme.confirm_password').'*', ['class' => 'col-sm-4 control-label']) !!}
                <div class="col-md-8">
                  {!! Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small>
                </div>
                <div class="col-sm-8">
                  {!! Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat']) !!}
                </div>
              </div>
            {!! Form::close() !!}
          </div>
        </div><!-- /col-md-8 -->
        <div class="col-md-3"></div>
      </div>
    </div><!-- /#password-tab -->

    <div role="tabpanel" class="tab-pane fade" id="address-tab">
      <div class="row">
        @forelse($account->addresses as $address)
          <div class="col-md-6 space50">
            {!! Form::model($address, ['method' => 'PUT', 'route' => ['my.address.update', $address], 'data-toggle' => 'validator']) !!}
              <fieldset>
                <legend>{{ $address->address_type . ' ' . trans('theme.address')}}</legend>

                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      {!! Form::select('address_type', $address_types, null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.address_type'), 'required']) !!}
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <a href="{{ route('my.address.delete', $address->id) }}" class="confirm btn btn-default btn-sm flat pull-right" data-confirm="@lang('theme.confirm_action.delete')"><i class="fa fa-trash-o"></i> @lang('theme.button.delete')</a>
                  </div>
                </div>

                @include('forms.address')

                <button type="submit" class='btn btn-default btn-sm flat pull-right'><i class="fa fa-save"></i> {{ trans('theme.button.update') }}</button>
              {!! Form::close() !!}
            </fieldset>
            <hr/>
          </div><!-- /.col-md-6 -->
        @empty
          <div class="clearfix space50"></div>
          <p class="lead text-center space50">
            @lang('theme.nothing_found')
          </p>
        @endforelse

        <div class="col-sm-12 text-center">
          <a href="#" data-toggle="modal" data-target="#createAddressModal" class="btn btn-black flat">
            <i class="fa fa-address-card-o"></i> @lang('theme.button.add_new_address')
          </a>
        </div>
      </div>
    </div><!-- /#address-tab -->
  </div><!-- /.tab-content -->
</div><!-- /.tabpanel -->

<div class="clearfix space50"></div>

@include('modals.create_address')