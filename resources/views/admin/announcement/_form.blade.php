<div class="form-group">
  {!! Form::label('body', trans('app.form.body').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="{{ trans('help.use_markdown_to_bold') }}"></i>
  {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.announcement_body'), 'rows' => '2', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
  	{!! Form::label('action_text', trans('app.form.action_text')) !!}
	<div class="input-group">
  		{!! Form::text('action_text', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.action_text') . ' ' . trans('help.optional')]) !!}
        <span class="input-group-addon">
	  		<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.announcement_action_text') }}"></i>
	  	</span>
	</div>
</div>
<div class="form-group">
  {!! Form::label('action_url', trans('app.form.action_url')) !!}
	<div class="input-group">
		{!! Form::text('action_url', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.action_url') . ' ' . trans('help.optional')]) !!}
        <span class="input-group-addon">
	  		<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.announcement_action_url') }}"></i>
	  	</span>
	</div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>