<li class="catesItem">
    <img data-src="{{img('_img/main-items-by-cates/'.$cateItem['main_img'])}}" class="Sirv" alt="">
    <div class="innerCatesItem">
        <div class="partA">
            <h3>{{$cateItem['title']}}</h3>
            <p class="desc">{{$cateItem['description']}}</p>
            <div class="frameItemPrices">
                <span style="color: #d70a0a">${{$cateItem['price']}}</span>
                <span style="text-decoration: line-through;">${{$cateItem['prev_price']}}</span>
            </div>
            <div class="allCentered buyNowWideButton" data-id="{{$cateItem['id']}}" style="
                                            ">
                <div class="allCentered buyIconFrame "><img class="Sirv"
                            data-src="{{img('_img/shopping-cart.png')}}" alt=""></div>
                <span>Add to cart</span>
            </div>
        </div>
    </div>
</li>