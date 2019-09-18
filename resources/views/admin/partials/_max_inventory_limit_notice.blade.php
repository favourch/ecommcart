<div class="alert alert-danger alert-dismissible">
    <strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
    {{ trans('messages.cant_add_more_inventory') }}
    <span class="indent15">
        <a href="{{ route('admin.account.billing') }}" class="btn bg-navy"><i class="fa fa-rocket"></i>  {{ trans('app.choose_plan') }}</a>
    </span>
</div>