@if(isset($banners['place_one']))
	<div class="row featured">
        @foreach($banners['place_one'] as $banner)
          @include('layouts.banner', $banner)
        @endforeach
    </div><!-- /.row -->
@endif