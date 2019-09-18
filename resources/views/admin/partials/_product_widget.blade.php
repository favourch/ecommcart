<div class="admin-user-widget">
    <span class="admin-user-widget-img">
        <img src="{{ get_storage_file_url(optional($product->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.image') }}">
    </span>

    <div class="admin-user-widget-content">
        <span class="admin-user-widget-title">
            {{ $product->name }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ $product->gtin_type.': '.$product->gtin }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.model_number').': '.$product->model_number }}
        </span>
        <span class="admin-user-widget-text text-muted">
            {{ trans('app.manufacturer').': '.optional($product->manufacturer)->name }}
            <i class="fa fa-check-square-o pull-right" style="position: absolute; right: 30px; top: 90px; font-size: 40px; color: rgba(0, 0, 0, 0.2);"></i>
        </span>
    </div>            <!-- /.admin-user-widget-content -->
</div>