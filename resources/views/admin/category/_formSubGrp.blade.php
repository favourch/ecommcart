<div class="form-group">
  {!! Form::label('category_group_id', trans('app.form.category_group').'*') !!}
  {!! Form::select('category_group_id', $catGroups , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.category_group'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
  {!! Form::label('name', trans('app.form.category_sub_grp_name').'*') !!}
  {!! Form::text('name', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.category_sub_grp_name'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('slug', trans('app.form.slug').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
  {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('active', trans('app.form.status').'*') !!}
  {!! Form::select('active', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>