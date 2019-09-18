<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('status', trans('app.form.status').'*') !!}
      {!! Form::select('status', $statuses , isset($ticket) ? $ticket->status : Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('priority', trans('app.form.priority').'*') !!}
      {!! Form::select('priority', $priorities , isset($ticket) ? $ticket->priority : Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.priority'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>