<article id="post-{{$post->id}}"
         class="post-{{$post->id}} post type-post status-publish format-image has-post-thumbnail hentry category-accessories category-actions category-business-use category-commercial-use category-fashion category-fly-high category-uncategorized tag-html tag-media tag-php tag-web-design post_format-post-format-image g-col-12 g-col-md-6">
    <div class="content-full">

        <div class="content-image">


            <a class="post-thumbnail" href="{{url('blog/post/'.$post->url)}}" aria-hidden="true">
                <img width="1665" height="1143" src="{{asset('_img/posts/'.$post->main_img)}}" class="img-fluid"/>
            </a>


            <div class="top-time">
                <div class="entry-date"
                     data-time="{{$post->created_at}}">{{Carbon\Carbon::parse($post->created_at)->format('d F Y')}}</div>
            </div>

        </div>

        <div class="content">
            <div class="bottom blog">
                <header class="entry-header">

                    <h3 class="entry-title"><a href="{{url('blog/post/'.$post->url)}}"
                                               rel="bookmark">{{$post->title}}</a></h3>
                    <div class="entry-meta">


                        @include('blog.inc.count-comments')

                        @include('blog.inc.author-name')

                        <div class="entry-category pull-left">
                            in
                            @include('blog.inc.post-categories')
                        </div>
                        <div class="tag-link">
                            <a href="http://demo3.wpopal.com/exgym/tag/html/" rel="tag">HTML</a>/<a
                                    href="http://demo3.wpopal.com/exgym/tag/media/" rel="tag">media</a>/<a
                                    href="http://demo3.wpopal.com/exgym/tag/php/" rel="tag">PHP</a>/<a
                                    href="http://demo3.wpopal.com/exgym/tag/web-design/" rel="tag">web design</a></div>

                    </div>
                    <!-- .entry-meta -->

                    <div class="entry-content">
                        {!! $post->description !!}
                    </div>
                    <!-- .entry-content -->

                    <div class="readmore"><a href="{{url('blog/post/'.$post->url)}}"> read more</a></div>

                </header>
                <!-- .entry-header -->


            </div>
        </div>
    </div>

</article>
