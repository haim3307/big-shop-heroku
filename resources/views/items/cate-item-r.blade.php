{{--animate-loaded-hide animated zoomIn--}}
<li class="catesItemR"{{-- v-show="loadedItem"--}}>
    @php($product->c_url = $product->c_url??$category->url)
    <a href="{{url("shop/$product->c_url/$product->url")}}" class="text-dark" style="text-decoration: none;">
        <div class="innerCatesItemR" style="background-image: url('{{asset("/_img/bg_items_white.png")}}');    background-size: cover;">
            <div class="quickViewWrap" style="position: absolute; top: 10px; left: 10px;">
                @include('items.buttons.quick-view')
            </div>
            <div class="partB">
                <img data-src="{{img("/_img/products/$product->c_url/$product->main_img")}}" class="Sirv" alt="">
            </div>
            <div class="partA">
                <h3>{{ucwords($product->title)}}</h3>
                <div class="desc my-text-overflow" style="max-height: 90px;">{!! $product->description !!}</div>
                <div class="frameItemPrices">
                    @if($product->prev_price)<span style="text-decoration: line-through; margin-right: 20px;">${{$product['prev_price']}}</span>@endif
                    <span style="color: #d70a0a">${{$product['price']}}</span>
                </div>
                @include('items.buttons.add-to-cart')
            </div>

        </div>
    </a>
</li>
