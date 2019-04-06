<div class="comments-link"><a
            href="{{url()->current()}}/#respond"
            class="comments-link">
        @if($post->comments->count())
            {{$post->comments->count()}}<span class="ml-2">comments</span>
        @else
            <span>No comments</span>
        @endif
    </a>
</div>