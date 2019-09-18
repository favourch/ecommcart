<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-history"></i> {{ trans('app.history') }}</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div> <!-- /.box-header -->
  <div class="box-body">
    <div id="menu">
      <div class="panel list-group">
        @forelse($logger->logs() as $log)
          @php
          // echo "<pre>"; print_r($log); echo "</pre>"; exit('fffff');
            $changes = $log->changes;
            // $changes = $log->changes()->all();
            // \Log::info($changes);
          @endphp

          <a class="list-group-item" data-toggle="collapse" data-target="#sl-{{ $log->id }}" data-parent="#menu">
            <span class="fa-stack fa-md">
              <i class="fa fa-circle-thin fa-stack-2x"></i>
              <i class="fa fa-check fa-stack-1x"></i>
            </span>
            {{ get_activity_title($log) }}
            <span class="pull-right">{{ $log->created_at->diffForHumans() }}</span>
          </a>
          <div id="sl-{{ $log->id }}" class="sublinks collapse">
            @if( ! empty($changes) && (strtolower($log->description) == 'updated'))
              @foreach($changes['attributes'] as $attrbute => $new_value)
                <p class="list-group-item  list-group-item-info">
                  <i class="fa fa-arrow-circle-o-right indent20"></i>
                  <span class="indent5">
                    {!! get_activity_str($logger, $attrbute, $new_value, $changes['old'][$attrbute]) !!}
                  </span>
                </p>
              @endforeach
            @else
                <p class="list-group-item  list-group-item-info"><i class="fa fa-arrow-circle-o-right indent20"> </i> <span class="indent5">{{ trans('messages.no_changes') }}</span></p>
            @endif
          </div>
        @empty
          <span class="indent5">{{ trans('messages.no_history_data') }}</span>
        @endforelse
      </div> <!-- /.panel -->
    </div> <!-- /#menu -->
  </div> <!-- /.box-body -->
</div> <!-- /.box -->