<div class="form-group">
    {!! Form::label('subject', trans('app.form.subject').'*') !!}
    {!! Form::text('subject', isset($message) ? $message->subject : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.subject'), 'required']) !!}
    <div class="help-block with-errors"></div>
</div>

<div class="form-group">
    {!! Form::label('message', trans('app.form.message').'*') !!}
    {!! Form::textarea('message', isset($message) ? $message->message : Null, ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => trans('app.placeholder.message'), 'required']) !!}
    <div class="help-block with-errors"></div>
</div>