@if(isset($banners['bottom']))
	<section>
	  <div class="container full-width">
    	  <div class="space20"></div>
	      <div class="row">
	        @foreach($banners['bottom'] as $banner)
	          @include('layouts.banner', $banner)
	        @endforeach
	    </div><!-- /.row -->
	  </div><!-- /.container -->
	</section>
@endif