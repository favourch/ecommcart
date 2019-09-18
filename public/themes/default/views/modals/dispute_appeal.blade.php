<div class="modal fade" id="disputeAppealModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content flat">
        <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            {{ trans('theme.appeal_dispute') }}
        </div>
        <div class="modal-body">
            {!! Form::model($order->dispute, ['method' => 'POST', 'route' => ['dispute.appeal', $order->dispute], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}

            @include('partials._reply')

            <button type="submit" class='btn btn-black btn-sm flat pull-right'>{{ trans('theme.button.submit') }}</button>
            {!! Form::close() !!}
            <small class="help-block text-muted">* {{ trans('theme.help.required_fields') }}</small>
        </div><!-- /.modal-body -->
        <div class="modal-footer">
        </div>
    </div><!-- /.modal-content -->
</div><!-- /#disputeOpenModal -->