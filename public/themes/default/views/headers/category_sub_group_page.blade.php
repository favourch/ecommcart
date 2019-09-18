<section>
    <div class="container">
        <header class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb nav-breadcrumb">
                      @include('headers.lists.home')
                      @include('headers.lists.categories')
                      @include('headers.lists.category_grp', ['category' => $category->group])
                      <li class="active">{{ $category->name }}</li>
                    </ol>
                </div>
            </div>
        </header>
    </div>
</section>