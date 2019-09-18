@extends('admin.layouts.master')

@section('content')
  <!-- Info boxes -->
  <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-credit-card"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.monthly_recuring_revenue') }}</span>
              <span class="info-box-number">
                  {{ get_formated_currency($monthly_recuring_revenue) }}
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i>
                  {{ trans('app.in_days', ['days' => 30]) }}
              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-percent"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('app.last_30_days_commission') }}</span>
                <span class="info-box-number">
                    {{ get_formated_currency($last_30_days_commission) }}
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i>
                  {{ trans('app.in_days', ['days' => 30]) }}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-green">
            <i class="fa fa-user-plus"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.new_vendors') }}</span>
              	<span class="info-box-number">
	                {{ $new_vendor_count }}
              	</span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i>
                  {{ trans('app.latest_hrs', ['hrs' => 24]) }}
                </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-red">
            <i class="fa fa-users"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.trialing_vendors') }}</span>
              	<span class="info-box-number">
                	{{ array_sum(array_column($data['subscribers'], 'trialing')) }}
              	</span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted"></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
      <!-- /.col -->
  </div>
  <!-- /.row -->

{{-- 	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.earnings') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
      <div>{!! $chartVisitors->container() !!}</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
 --}}
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.subscription_plans') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
        	<div class="row">
            	<div class="col-sm-7 nopadding-right">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>{{ trans('app.name') }}</th>
								<th>{{ trans('app.subscribers') }}</th>
								<th>{{ trans('app.trialing') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data['subscribers'] as $subscriber)
								<tr>
									<td>{{ $subscriber['name'] }}</td>
									<td>{{ $subscriber['count'] }}</td>
									<td>{{ $subscriber['trialing'] }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
            	</div>
            	<div class="col-sm-5 nopadding-left">
            		{!! $chartSubscribers->container() !!}
        		</div>
        	</div> <!-- /.row -->
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection

@section('page-script')
	@include('plugins.chart')
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>

	{!! $chartSubscribers->script() !!}
@endsection
