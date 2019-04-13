<button class="buyNowWideButton addToCartB" @click="addToCartEvent" ref="addToCart" data-product='{!! $product !!}' data-toggle="modal" data-target="#product_view"
   :data-id="{!! $product->id !!}">
    <div class="allCentered buyIconFrame">
        <i class="fa fa-cart-plus text-white"></i>
    </div>
    <span class="btnTitle">Add to cart</span>
</button>