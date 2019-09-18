<div class="admin-user-widget">
    <span class="admin-user-widget-img">
        <img src="{{ get_storage_file_url(optional($customer->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.avatar') }}">
    </span>

    <div class="admin-user-widget-content">
        <span class="admin-user-widget-title">
            {{ trans('app.customer') . ': ' . $customer->name }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.email') . ': ' . $customer->email }}
        </span>
        @if($customer->primaryAddress)
            <span class="admin-user-widget-text text-muted">
                {{ trans('app.phone') . ': ' . $customer->primaryAddress->phone }}
            </span>
            <span class="admin-user-widget-text text-muted">
                {{ trans('app.zip_code') . ': ' . $customer->primaryAddress->zip_code }}
            </span>
        @endif

        @can('view', $customer)
            <a href="#" data-link="{{ route('admin.admin.customer.show', $customer->id) }}" class="ajax-modal-btn small">{{ trans('app.view_detail') }}</a>
        @endcan

        <i class="fa fa-check-square-o pull-right" style="position: absolute; right: 30px; top: 90px; font-size: 40px; color: rgba(0, 0, 0, 0.2);"></i>
    </div>            <!-- /.admin-user-widget-content -->
</div>          <!-- /.admin-user-widget -->