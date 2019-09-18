@foreach($product->categories as $category)
	<span class="label label-outline">{{ $category->name }}</span>
@endforeach
