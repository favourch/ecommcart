<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	<i class="icon fa fa-info-circle"></i> {{ trans('app.notice') }}
        </div>
        <div class="modal-body">
            <p class="text-warning">{!! trans('messages.cant_add_more_user') !!}</p>
        </div>
        <div class="modal-footer">
            <a href="{{ route('admin.account.billing') }}" class="btn btn-lg btn-new"><i class="fa fa-rocket"></i>  {{ trans('app.choose_plan') }}</a>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->