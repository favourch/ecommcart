@if(isset($banners['place_three']))
    <div class="space20"></div>
	<div class="row featured">
        @foreach($banners['place_three'] as $banner)
          @include('layouts.banner', $banner)
        @endforeach
    </div><!-- /.row -->
@endif