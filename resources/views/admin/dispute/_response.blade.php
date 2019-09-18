<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::model($dispute, ['method' => 'POST', 'route' => ['admin.support.dispute.storeResponse', $dispute->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.response') }}
        </div>
        <div class="modal-body">

            <div class="form-group">
                {!! Form::label('status', trans('app.form.status').'*') !!}
                @if( !Auth::user()->isFromPlatform() && ($dispute->status == \App\Dispute::STATUS_APPEALED))
                    {!! $dispute->statusName() !!}
                @else
                    {!! Form::select('status', $statuses , Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
                    <div class="help-block with-errors"></div>
                @endif
            </div>

            @include('admin.partials._reply')

            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.reply'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->