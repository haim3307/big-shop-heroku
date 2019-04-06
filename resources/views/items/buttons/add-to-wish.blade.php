<button class="btn allCentered addToWishB" data-wish-id="{{$item->id}}"
        style="position: relative; padding: 0; justify-content: stretch; border-radius: 0; font-size: 16px;font-weight: 400;color: #FFFFFF;">
    <div class="allCentered"
         style="height: 38px; width: 42px; background-color: rgb(247, 24, 24);">
        <i class="fa @if($inWishList) fa-heart @else fa-heart-o @endif"></i>
        @include('items.inc.wishlist-message',['product'=>$item,'style'=>$style??''])
        @auth @else <div class="itemMessage signToWish fade" data-wish-id="{{$item->id}}" style="{{$style??''}}">Please <a style="color: #007bff !important;" href="{{route('login',['rt'=>url()->current()])}}" class="link">login</a> in order to use the wish list</div> @endauth
    </div>
</button>