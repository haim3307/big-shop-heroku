<button class="buyNowWideButton addToCartB" @include('inc.print-object',['product'=>$product->toArray()]) data-toggle="modal" data-target="#product_view" data-id="{{$product['id']}}">
                        <span class="allCentered buyIconFrame "><img alt="" data-src="{{img('/_img/shopping-cart.png')}}" class="Sirv">
                        </span>
    <span class="btnTitle">Add to cart</span>
</button>