<section>
  <div class="container">
    <header class="page-header">
      <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb nav-breadcrumb">
            @include('headers.lists.home')
            @if($category != 'all_categories')
              @include('headers.lists.category', ['category' => $category])
            @else
              @include('headers.lists.categories')
            @endif
            <li class="active">@lang('theme.search_results')</li>
            <li class="active">"<strong class="text-primary">{{ Request::get('search') }}</strong>"</li>
          </ol>
        </div>
      </div>
    </header>
  </div>
</section>