<section>
  <div class="container">
    <div class="row">
      <div class="section-title space20">
        <h4>{!! trans('theme.section_headings.select_from_categories') !!}</h4>
      </div>
      @foreach($all_categories as $categoryGroup)
        @if($categoryGroup->subGroups->count())
          <div class="col-md-3 col-sm-6 bg-light category-widget space30">
            <section class="category-banner-img-wrapper">
              <div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($categoryGroup, 'category') }} );">
                <div class="banner-caption">
                  <span class="lead">{{ $categoryGroup->name }}</span>
                </div>
              </div>
            </section>
            @foreach($categoryGroup->subGroups as $subGroup)
              <h5 class="nav-category-inner-title">{{ $subGroup->name }}</h5>
              <ul class="nav-category-inner-list">
                @foreach($subGroup->categories as $cat)
                  <li><a href="{{ route('category.browse', $cat->slug) }}">{{ $cat->name }}</a>
                    @if($cat->description)
                      <p>{{ $cat->description }}</p>
                    @endif
                  </li>
                @endforeach
              </ul>
            @endforeach
          </div><!-- /.col-md-3 -->
          @if($loop->iteration % 4 == 0)
            <div class="clearfix"></div>
          @endif
          @if($loop->iteration % 2 == 0)
            <!-- Add clearfix for only the sm viewport -->
            <div class="clearfix visible-sm-block"></div>
          @endif
        @endif
      @endforeach
    </div><!-- /.row -->
  </div><!-- /.container -->
</section>