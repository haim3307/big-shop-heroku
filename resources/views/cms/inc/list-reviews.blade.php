@foreach($reviews as $review)
    <div class="comment-head-dash clearfix mb-3">
        @include('items.review-item',['colA'=>'3','colB'=>'9'])
        <div class="text-center">
            About <a href="{{url("cms/product/{$review->product->id}/edit")}}">{{$review->product->title}}</a>
        </div>
    </div>
@endforeach