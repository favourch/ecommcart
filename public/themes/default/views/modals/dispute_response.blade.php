<div class="modal fade" id="disputeResponseModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content flat">
        <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            {{ trans('theme.dispute') }}
        </div>
        <div class="modal-body">
            {!! Form::model($order->dispute, ['method' => 'POST', 'route' => ['dispute.response', $order->dispute], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            <div class="row select-box-wrapper">
                <div class="form-group col-md-12">
                    {!! Form::label('status', trans('theme.status').'*') !!}
                    {!! Form::select('status', \App\Helpers\ListHelper::dispute_statuses() , Null, ['class' => 'selectBoxIt', 'required']) !!}
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            @include('partials._reply')

            <button type="submit" class='btn btn-black btn-sm flat pull-right'>{{ trans('theme.button.submit') }}</button>
            {!! Form::close() !!}
            <small class="help-block text-muted">* {{ trans('theme.help.required_fields') }}</small>
        </div><!-- /.modal-body -->
        <div class="modal-footer">
        </div>
    </div><!-- /.modal-content -->
</div><!-- /#disputeOpenModal -->