<div class="clearfix space20"></div>
<section>
  	<div class="container">
    	<div class="row">
      		<div class="col-md-12">

				@if($products->count())

		        	@include('contents.product_list')

				@else

					<div class="clearfix space50"></div>
					<p class="lead text-center space50">
					  	<span class="space50">@lang('theme.no_product_found')</span><br/>
					  	<div class="space50 text-center">
						  	<a href="{{ url('categories') }}" class="btn btn-primary btn-sm flat">@lang('theme.button.choose_from_categories')</a>
					  	</div>
					</p>
					<div class="clearfix space50"></div>

				@endif
      		</div><!-- /.col-md-12 -->
    	</div><!-- /.row -->
  	</div><!-- /.container -->
</section>
<div class="clearfix space20"></div>