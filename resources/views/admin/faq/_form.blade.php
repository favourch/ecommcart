<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('question', trans('app.form.faq_question').'*') !!}
      {!! Form::text('question', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.faq_question'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('faq_topic_id', trans('app.form.topic').'*') !!}
      {!! Form::select('faq_topic_id', $topics, Null, ['class' => 'form-control select2-normal', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="form-group">
  {!! Form::label('answer', trans('app.form.faq_answer').'*') !!}
  {!! Form::textarea('answer', null, ['class' => 'form-control summernote-min', 'placeholder' => trans('app.placeholder.faq_answer'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<h5 class="box-title"><i class="fa fa-code"></i> {{ trans('app.short_codes') }}</h5>
<pre>
  :marketplace :marketplace_url
</pre>
<div class="help-block with-errors">{{ trans('help.faq_placeholders') }}</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>