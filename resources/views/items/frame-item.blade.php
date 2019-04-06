@php($frameItem->c_url = $frameItem->c_url??$frameItem->mainCategory->url)
<div  is="frame-item" :product='{!! $frameItem !!}' inline-template>
    <div onclick="window.location = '{{url("shop/{$frameItem->c_url}/$frameItem->url")}}'"
         class="frameItem dragItem carousel-cell">
        <div class="g-col-2 centered-g-items allCentered"
             style="overflow:hidden;background-color:#fff; height: 145px;">
            <img class="Sirv"
                 data-src="{{img('_img/products/'.($frameItem->c_url??$frameItem->mainCategory->url).'/'.$frameItem->main_img)}}"
                 alt="" >
        </div>
        <h3 class="my-text-overflow">{{ucfirst($frameItem->title)}}</h3>
        <div class="frameItemPrices">
            @if(isset($frameItem->prev_price))
                <s style=" margin-right: 20px">${{$frameItem->prev_price}}</s>
            @endif
            <span style="color: #d70a0a;">${{$frameItem->price}}</span>
        </div>
        <a class="allCentered  addToCartB" @click="addToCartEvent" ref="addToCart" data-product='{!! $frameItem !!}' data-toggle="modal" data-target="#product_view"
           :data-id="{!! $frameItem->id !!}">
            <div class="allCentered">
                <i class="fa fa-cart-plus text-white"></i>
            </div>
        </a>
    </div>
</div>
