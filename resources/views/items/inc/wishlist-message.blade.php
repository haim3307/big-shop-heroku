@if(Session::get('addedToWishList') && Session::get('addedToWishList') == $product->id)
    <div class="addedToWishMessage itemMessage" style="{{$style??''}}">{{$message??'Added to wish list!'}}</div> @endif
