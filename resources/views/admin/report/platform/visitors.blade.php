@extends('admin.layouts.master')

@section('content')
    @if(config('system_settings.google_analytic_report') && \App\SystemConfig::isGgoogleAnalyticConfigured())
      	<div class="box">
	        <div class="nav-tabs-custom" style="box-shadow: none;">
	          	<ul class="nav nav-tabs nav-justified">
		            <li class="active"><a href="#visitors_tab" data-toggle="tab">
		              <i class="fa fa-users hidden-sm"></i>&nbsp;
		              {{ trans('app.visitors') }}
		            </a></li>
		            <li><a href="#referrals_tab" data-toggle="tab">
		              <i class="fa fa-anchor hidden-sm"></i>&nbsp;
		              {{ trans('app.top_referrals') }}
		            </a></li>
		            <li><a href="#behavior_tab" data-toggle="tab">
		              <i class="fa fa-compass hidden-sm"></i>&nbsp;
		              {{ trans('app.behavior') }}
		            </a></li>
	          	</ul>
	          	<!-- /.nav .nav-tabs -->

	          	<div class="tab-content">
		            <div class="tab-pane active" id="visitors_tab">
		              <div>{!! $chartVisitors->container() !!}</div>
		            </div>
		            <!-- /.tab-pane -->

		            <div class="tab-pane" id="referrals_tab">
		              <div>{!! $chartReferrers->container() !!}</div>
		            </div>
		            <!-- /.tab-pane -->

		            <div class="tab-pane" id="behavior_tab">
		            	<div class="row">
			            	<div class="col-sm-6 nopadding-right">
			            		{!! $chartVisitorTypes->container() !!}
			            	</div>
			            	<div class="col-sm-6 nopadding-left">
			            		{!! $chartDevices->container() !!}
		            		</div>
		            	</div>
		            </div>
		            <!-- /.tab-pane -->
	          	</div>
	          	<!-- /.tab-content -->
	        </div>
	        <!-- /.nav-tabs-custom -->

	        <div class="box-footer clearfix text-muted">
				<i class="fa fa-info-circle"></i> {{ trans('app.latest_months', ['months' => config('charts.google_analytic.period')]) }}
				{{ trans('app.data_from_google') . '. You can change this value from config/charts.php page.' }}
	        </div>
      	</div>
      	<!-- /.box -->
    @endif

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.visitors') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover" id="all-visitors-table">
				<thead>
					<tr>
						<th>{{ trans('app.ip') }}</th>
						<th>{{ trans('app.hits') }}</th>
						<th>{{ trans('app.page_views') }}</th>
						<th>{{ trans('app.last_visits') }}</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection

@section('page-script')
    @if(config('system_settings.google_analytic_report') && \App\SystemConfig::isGgoogleAnalyticConfigured())
		@include('plugins.chart')
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>

		{!! $chartVisitors->script() !!}
		{!! $chartReferrers->script() !!}
		{!! $chartVisitorTypes->script() !!}
		{!! $chartDevices->script() !!}
	@endif

	<script type="text/javascript">
		$('#all-visitors-table').DataTable({
		  	// "aaSorting": [],
		    "aaSorting": [[ 1, "desc" ]],
		    "iDisplayLength": {{ getPaginationValue() }},
	        "processing": true,
	        "serverSide": true,
	        "ajax": "{{ route('admin.report.visitors.getMore') }}",
			"columns": [
	            { 'data': 'ip', 'name': 'ip' },
	            { 'data': 'hits', 'name': 'hits', 'searchable': false },
	            { 'data': 'page_views', 'name': 'page_views', 'searchable': false },
	            { 'data': 'last_visits', 'name': 'last_visits', 'searchable': false },
	            { 'data': 'option', 'name': 'option', 'orderable': false, 'searchable': false, 'exportable': false, 'printable': false }
	        ],
		    "oLanguage": {
		        "sInfo": "_START_ to _END_ of _TOTAL_ entries",
		        "sLengthMenu": "Show _MENU_",
		        "sSearch": "",
		        "sEmptyTable": "No data found!",
		        "oPaginate": {
		          "sNext": '<i class="fa fa-hand-o-right"></i>',
		          "sPrevious": '<i class="fa fa-hand-o-left"></i>',
		        },
		    },
		    "aoColumnDefs": [{
		        "bSortable": false,
		        "aTargets": [ -1 ]
		     }],
			"lengthMenu": [
				[10, 25, 50, -1],
				[ '10 rows', '25 rows', '50 rows', 'Show all' ]
			],     // page length options
		    dom: 'Bfrtip',
		    buttons: [
		        	'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
		    	]
	    });
	</script>
@endsection
