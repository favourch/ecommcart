@if (Session::has('success'))
	<script type="text/javascript">
	    @include('layouts.notification', ['message' => Session::get('success'), 'type' => 'success'])
	</script>
@elseif (Session::has('warning'))
	<script type="text/javascript">
	    @include('layouts.notification', ['message' => Session::get('warning'), 'type' => 'warning', 'icon' => 'warning'])
	</script>
@elseif (Session::has('error'))
	<script type="text/javascript">
	    @include('layouts.notification', ['message' => Session::get('error'), 'type' => 'danger', 'icon' => 'warning'])
	</script>
@elseif (Session::has('info'))
	<script type="text/javascript">
	    @include('layouts.notification', ['message' => Session::get('info'), 'type' => 'info', 'icon' => 'info'])
	</script>
@endif