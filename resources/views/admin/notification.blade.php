<!-- Notie -->
{{-- <script src="{{asset("assets/plugins/notie/notie.js") }}"></script> --}}

@if (Session::has('success'))
	<script type="text/javascript">
		notie.alert(1, '{{ Session::get('success') }}', 2);
	</script>
@elseif (Session::has('warning'))
	<script type="text/javascript">
		notie.alert(2, '{{ Session::get('warning') }}', 2);
	</script>
@elseif (Session::has('error'))
	<script type="text/javascript">
		notie.alert(3, '{{ Session::get('error') }}', 4);
	</script>
@elseif (Session::has('info'))
	<script type="text/javascript">
		notie.alert(4, '{{ Session::get('info') }}', 4);
	</script>
@endif