<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-cart-arrow-down"></i> {{ trans('app.cart_list') }}</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
        <table class="table table-hover table-no-option">
            <thead>
                <tr>
                    <th>{{ trans('app.created_at') }}</th>
                    <th>{{ trans('app.customer') }}</th>
                    <th>{{ trans('app.items') }}</th>
                    <th>{{ trans('app.quantities') }}</th>
                    <th>{{ trans('app.grand_total') }}</th>
                    <th class="text-right">{{ trans('app.option') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart_lists as $cart_list )
                    <tr>
                        <td>{{ $cart_list->created_at->diffForHumans() }}</td>
                        <td>{{ $cart_list->customer->name }}</td>
                        <td>{{ $cart_list->item_count }}</td>
                        <td>{{ $cart_list->quantity }}</td>
                        <td>{{ get_formated_currency($cart_list->grand_total) }}</td>
                        <td class="row-options">
                            <div class="btn-group">
                                @if(Gate::allows('create', App\Order::class) || Gate::allows('update', $cart_list))
                                    {!! Form::open(['route' => ['admin.order.order.create'], 'method' => 'get', 'style' => 'display:inline;']) !!}
                                        {{ Form::hidden('customer_id',$cart_list->customer->id) }}
                                        {{ Form::hidden('cart_id',$cart_list->id) }}
                                        <button type="submit" class="btn btn-sm btn-default">
                                            <i data-toggle="tooltip" data-placement="top" title="{{ trans('app.use_this_cart') }}" class="fa fa-check"></i> {{ trans('app.use') }}
                                        </button>
                                    {!! Form::close() !!}
                                @endif
                                @can('view', $cart_list)
                                    <a href="#" data-link="{{ Route('admin.order.cart.show', $cart_list->id) }}" class="ajax-modal-btn btn btn-sm btn-default">
                                        <i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i>
                                    </a>
                                @endcan
                                @can('delete', $cart_list)
                                    {!! Form::open(['route' => ['admin.order.cart.trash', $cart_list->id], 'method' => 'delete', 'style' => 'display:inline;']) !!}
                                        <button type="submit" class="btn btn-sm btn-default confirm ajax-silent">
                                            <i data-toggle="tooltip" data-placement="top" title="{{ trans('app.trash') }}" class="fa fa-trash-o"></i>
                                        </button>
                                    {!! Form::close() !!}
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- /.box-body -->
</div> <!-- /.box -->
