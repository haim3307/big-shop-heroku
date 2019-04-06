<div class="product-wrapper product"  style="position: relative;">
    @include('items.inc.wishlist-message',['product'=>$product->entityItem,'style'=>'top:150px'])
    @auth @else <div class="itemMessage signToWish fade" data-wish-id="{{$product->entityItem->id}}">Please <a style="top: 150px; color: #007bff !important;" href="{{url('login')}}" class="link">login</a> in order to use the wish list</div> @endauth

    <div class="product-block"
         data-product-id="{{$product->entityItem->id}}">
        <figure class="image" style="min-height: 328px;">

            <span class="onsale">Sale!</span>
            <a @isset($dealMode) style="display: block;height: 479px;" @endisset title="{{$product->entityItem->title}}"
               href="{{url("shop/{$product->entityItem->c_url}/{$product->entityItem->url}")}}"
               class="product-image">
                <img width="800" height="800"
                     src="{{asset("_img/products/{$product->entityItem->c_url}/{$product->entityItem->main_img}")}}"
                     class="attachment-shop_catalog image-effect"
                     alt=""/><img width="1000"
                                  height="1000"
                                  src="{{asset("_img/products/{$product->entityItem->c_url}/{$product->entityItem->main_img}")}}"
                                  class="image-hover wp-post-image"
                                  alt=""/>
                <span class="onsale-wrap">
                <span class="onsale">
                -  {{$product->options->discount->value}}%		    </span>
                </span>

            </a>

            <div class="button-action button-groups clearfix">
                <div class="action clearfix">

                    <div class="quick-view hidden-xs hidden-sm">
                        <a title="Quick view"
                           href="#"
                           class="quickview"
                           data-toggle="modal">
                            @include('items.buttons.quick-view',['product'=>$product->entityItem])

                        </a>
                    </div>


                    <div class="yith-wcwl-add-to-wishlist add-to-wishlist-5296 addToWishB" data-wish-id="{{$product->entityItem->id}}" data-wish-url="{{$product->entityItem->url}}">
                        <div class="yith-wcwl-add-button show"
                             style="display:block">
                            <a title="Add to wishlist"
                               rel="nofollow"
                               data-product-id="{{$product->entityItem->id}}"
                               data-product-type="simple"
                               class="add_to_wishlist">
                                <i class="fa @if($product->entityItem->inWishList) fa-heart @else fa-heart-o @endif"></i><span>Wishlist</span></a>
                        </div>

                        <div class="yith-wcwl-wishlistaddedbrowse hide"
                             style="display:none;">
                            <span class="feedback">Product added!</span>
                            <a href="{{url('user/wishlist')}}"
                               rel="nofollow">
                                <i class="fa fa-heart"></i><span>Wishlist</span>
                            </a>
                        </div>

                        <div class="yith-wcwl-wishlistexistsbrowse hide"
                             style="display:none">
                            <span class="feedback">The product is already in the wishlist!</span>
                            <a href="{{url('user/wishlist')}}"
                               rel="nofollow">
                                <i class="fa fa-heart"></i><span>Wishlist</span>
                            </a>
                        </div>

                        <div style="clear:both"></div>
                        <div class="yith-wcwl-wishlistaddresponse">
                        </div>

                    </div>

                    <div class="clear"></div>

{{--                    <div class="yith-compare">
                        <a title="Add to compare"
                           href="/exgym/on-sale/?action=yith-woocompare-add-product&amp;id=5296&amp;_wpnonce=27c367e6a9"
                           class="compare"
                           data-product_id="5296">
                            <i class="fa fa-retweet"></i>
                            <span>Compare</span>
                        </a>
                    </div>--}}
                    <div class="add-cart">
                        <a title="Add to cart"
                           rel="nofollow"
                           class="button product_type_external btn btn-primary addToCartB" @include('inc.print-object',['product'=> $product->entityItem->getAttributes()])><i
                                    class="fa fa-shopping-cart"></i><span
                                    class="title-cart btnTitle">Add To Cart</span></a>
                    </div>
                </div>


            </div>

            @isset($dealMode)
                <div class="time-wrapper">
                    <div class="time">
                        <div class="timer-left">
                            Time
                            Left:
                        </div>
                        <div class="pts-countdown clearfix"
                             data-countdown="countdown"
                             data-date="{{Carbon\Carbon::parse($deal->options->end_date->value)->format('M-d-Y-h-m-i')}}">
                            {{--->format('M d Y')--}}
                            {{--05-30-2018-00-00-00--}}
                            <div class="countdown-times">
                                <div class="day">
                                    <b>30</b>
                                    <span>Days</span>
                                </div>
                                <div class="hours">
                                    <b>12</b>
                                    <span>Hours</span>
                                </div>
                                <div class="minutes">
                                    <b>16</b>
                                    <span>Mins</span>
                                </div>
                                <div class="seconds">
                                    <b>26</b>
                                    <span>Secs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </figure>


        <div class="caption">


            <div class="myRating f-row justify-content-center">
                <star-rating :border-width="1" :show-rating="false" :rating="{{$product->entityItem->rating}}" :round-start-rating="false" :star-size="20" :read-only="true"></star-rating>
            </div>
            <h3 class="name"><a href="{{url("shop/{$product->entityItem->c_url}/{$product->entityItem->url}")}}">{!! !strip_tags($product->title)?$product->entityItem->title:$product->title !!}</a></h3>

            <div class="category-name">
                <a href="{{url("shop/{$product->entityItem->c_url}")}}">{{$product->entityItem->c_url}}</a>
            </div>

            <div class="meta">

                                                                                        <span class="price"><ins><span
                                                                                                        class="woocommerce-Price-amount amount"><span
                                                                                                            class="woocommerce-Price-currencySymbol">&#36;</span>20.00</span></ins><del><span
                                                                                                        class="woocommerce-Price-amount amount"><span
                                                                                                            class="woocommerce-Price-currencySymbol">&#36;</span>29.99</span></del></span>


            </div>

        </div>


    </div>
</div>