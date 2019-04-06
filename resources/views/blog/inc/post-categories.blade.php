<div class="d-inline-block">
        <ul @isset($separator) class="post-categories f-row m-0 ml-1" @else class="post-categories" @endif>
                @foreach($post->categories as $postCategory)
                        <li><a href="{{url("blog/category/$postCategory->url")}}"
                               rel="category tag">{{ucwords($postCategory->name)}}</a></li>{{$post->categories->count() > 1?$separator??'':''}}
                @endforeach
        </ul>
</div>