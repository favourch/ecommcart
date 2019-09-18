<!-- CONTENT SECTION -->
<div class="clearfix space20"></div>
<section>
	<div class="container">
        <div class="row row-col-border" data-gutter="60">
            <div class="col-md-9">
                <article class="blog-post">
                    @if($blog->image)
                        <a href="{{ route('blog.show', $blog->slug) }}">
				            <img class="full-width" src="{{ get_storage_file_url(optional($blog->image)->path, 'full') }}" alt="{{ $blog->title }}" title="{{ $blog->title }}" />
                        </a>
                    @endif

                    <h1 class="blog-post-title"><a href="{{ route('blog.show', $blog->slug) }}">{!! $blog->title !!}</a></h1>
                    <ul class="blog-post-meta">
                        <li>{{ trans('theme.published_at') . ' ' . $blog->published_at->diffForHumans() }}</li>
                        <li>by <a href="{{ route('blog.author', $blog->user_id) }}">{!! $blog->author->getName() !!}</a>
                        </li>
                    </ul>

                    <p class="blog-post-body">
                        {!! $blog->content !!}
                    </p>
                </article>

                <!--
                <hr class="style3"/>
                <h3 class="widget-title">Leave a Comment</h3>
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name *</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>E-mail *</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Website</label>
                                <input class="form-control" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Leave a Comment" />
                </form>
                <div class="gap gap-small"></div>
                <hr />

                <h3 class="widget-title">8 Comments</h3>

                <ul class="comments-list">
                    @foreach($blog->comments as $comment)
                        <li>
                            <article class="comment">
                                <div class="comment-author">
                                    <img src="img/70x70.png" alt="Image Alternative text" title="Image Title" />
                                </div>
                                <div class="comment-inner"><span class="comment-author-name">{{ $comment->author->getName() }}</span>
                                    <p class="comment-content">
                                        <span>{!! $comment->content !!}</span>
                                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
                 END COMMENTS -->

                <div class="clearfix space50"></div>
            </div> <!-- /.col-md-9 -->

            <div class="col-md-3">
                @include('partials._blog_sidebar')
            </div> <!-- /.col-md-3 -->
        </div>
		<div class="clearfix space50"></div>
  	</div><!-- /.container -->
</section>