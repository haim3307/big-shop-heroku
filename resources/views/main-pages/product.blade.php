@extends('layouts.master')
@section('content')

    <div class="container-1112">
        <div class="productPage">
            <header>
                @include('site-route-nav.views.general')
            </header>
            <main>
                <div class="container-fluid">
                    <div class="itemStage f-row">
                        <div class="productImages container col-md-6">
                            <div class="productImgStage p-md-4">
                                <div class="frameMy" style="position: absolute; z-index: 2;">
                                    <img src="{{img('_img/layout/price.png')}}" alt="">
                                    <p class="text-white" style="position: relative; top: -50px; left: 20px;">
                                        ${{$item->price}}</p>
                                </div>
                                <div style="border: 1px lightgrey solid;      margin: 10px;">
                                    <img width="500"
                                         src="{{isset($item->main_img)?img('_img/products/'. $category->name .'/'.$item->main_img):'http://via.placeholder.com/1100x700?text=No Product Image'}}"
                                         class="img-fluid" alt="">
                                </div>
                                {{--                            <div class="carousel carousel-main" style="border: 1px lightgrey solid;"
                                                                 data-flickity='{"pageDots": false,"imagesLoaded": true}'>
                                                                @for ($i = 0; $i < 1; $i++)

                                                                    <div class="carousel-cell">
                                                                        <img style="min-width: 500px" width="500" src="{{isset($item->main_img)?asset('_img/products/'. $category->name .'/'.$item->main_img):'http://via.placeholder.com/1100x700?text=No Product Image'}}"
                                                                             class="img-fluid" alt="">
                                                                    </div>
                                                                @endfor

                                                            </div>--}}

                            </div>
                            <div class="productImagesMenu" style="display: none;">
                                @isset($item->main_img)


                                    {{--                                <div class="carousel carousel-nav"
                                                                         data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false,"prevNextButtons": false
                                     }'>
                                                                        @for ($i = 0; $i < 4; $i++)
                                                                            <div class="carousel-cell">
                                                                                <div class="productImageSquare">
                                                                                    <img class="img-fluid"
                                                                                         src="{{img('_img/products/'. $category->name .'/'.$item->main_img)}}"
                                                                                         alt="">
                                                                                </div>
                                                                            </div>
                                                                        @endfor

                                                                    </div>--}}

                                @else
                                    <h4>No Product Images Available</h4>
                                @endisset

                            </div>
                        </div>
                        <div class="productDesc col-md-6">
                            <div class="productTitle d-grid">
                                <h2 class="text-capitalize my-text-overflow">{{$item->title}}</h2>
                                <div style="display: flex; justify-content: space-between;">
                                    <p>Posted in <span class="productAlert ">{{$category->name}}</span></p>
                                </div>
                                <div>
                                    <star-rating :show-rating="false" :rating="{{$item->rating}}"
                                                 :round-start-rating="false" :star-size="20"
                                                 :read-only="true"></star-rating>
                                </div>
                            </div>
                            <hr>
                            <div class="innerProductDesc">
                                <div>{!! $item->description !!}</div>
                                @if($item->stock)
                                    <p style="padding: 17px 0 22px 0;">In Stock - <span>{{$item->stock}}</span> available
                                    </p>
                                @else
                                    <p class="text-danger">Out Of Stock!</p>
                                @endif
                                <div class="callToAction f-row">
                                    {{--                                <input type="number" min="1" value="1"
                                                                           style="text-align: center; margin-right: 14px; width: 46px;">--}}
                                    <div style="margin-right: 10px;"  class="addToCartB buyPageButtons d-flex mb-md-2 mb-lg-0">
                                        @push('styles')
                                            <style>
                                                .storeBTN{
                                                    height: 38px; flex-basis: 173px; padding: 0; justify-content: stretch; border-radius: 0;
                                                }
                                                .storeBTN>div,.storeBTN>span{
                                                    height: 38px;
                                                }
                                                .storeBTN>span{
                                                    background-color: #e1e1e1; padding: 0 11px;
                                                }
                                                .storeBTN>div{
                                                    background-color: rgb(247, 24, 24);
                                                    width: 42px;
                                                }
                                            </style>
                                        @endpush
                                        <button class="btn allCentered addToCartProductPage storeBTN mr-md-2" @click="addToCartEvent" ref="addToCart" data-product='{!! $item !!}' data-toggle="modal" data-target="#product_view"
                                                :data-id="{!! $item->id !!}">
                                            <div class="allCentered">
                                                <img src="{{img('_img/Shopping Cart 3.png')}}" alt=""></div>
                                            <span class="allCentered btnTitle">Add to cart</span>
                                        </button>
                                        <button class="btn allCentered buyNow storeBTN"  @click="buyNow">
                                            <div class="allCentered">
                                                <img src="{{img('_img/Shopping Cart 3.png')}}" alt=""></div>
                                            <span class="allCentered buyNow">Buy Now</span>
                                        </button>
                                    </div>
                                    @include('items.buttons.add-to-wish',['style'=>'top:50px;']){{--,'top'=>'150px','right'=>'10px','top'=>'100px','right'=>'-140px'--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="publicTabs" id="publicTabs">
                    <nav style="background-color: #252525; border-bottom: 4px solid #f71818; border-radius: 0px 10px 10px 10px ;">
                        <ul class="d-flex">
                            <li><a class="allCentered text-white" href="#reviews">Reviews</a></li>
                            <li><a class="allCentered text-white" href="#description">Description</a></li>
                        </ul>
                    </nav>

                    <div class="innerPublicTabs">
                        <div id="reviews">

                            <h2 style="margin: 30px 0 19px 0;">Reviews</h2>
                            <div>
                                @foreach(array_merge($reviews,$item->reviews->all()) as $review)
                                    @include('items.review-item')
                                @endforeach

                                @if (Auth::check())
                                    <section id="userReview">
                                        @include('auth.errors')
                                        <form action="{{url()->current()}}/review"
                                              class="addComment d-grid productConShadow" method="post">
                                            {{csrf_field()}}
                                            <h2 class="g-col-md-12" style="color:  #f71818;">Add Review
                                                <hr style="margin: 10px 0;">
                                            </h2>
                                            <div class="input-g-group d-grid g-col-md-3">
                                                <label for="commentRating">Rating (<span
                                                            class="myAlert">required</span>):</label>
                                                <star-rating v-model="rating" :show-rating="false" :rating="3"
                                                             :round-start-rating="false" :star-size="20"></star-rating>
                                                <input type="hidden" :value="rating" name="rating">
                                            </div>

                                            <div class="input-g-group d-grid g-col-md-3">

                                            </div>

                                            <div class="input-g-group d-grid g-col-md-3">

                                            </div>

                                            <div class="input-g-group d-grid g-col-md-3">
                                                <div class="form-group">
                                                    <input type="submit" value="Submit"
                                                           class="form-control submit btn btn-primary">
                                                </div>
                                            </div>
                                            <div class="input-g-group d-grid g-col g-col-md-12"
                                                 style="grid-template-rows: 30px 1fr;">
                                                <label for="commentContent">Your review (<span
                                                            class="myAlert">required</span>):</label>
                                                <textarea style="min-height: 93px;" class="form-control"
                                                          name="description"
                                                          id="commentContent"></textarea>
                                            </div>
                                        </form>
                                    </section>
                                @else
                                    <p>You have to <a class="link" href="{{route('login',['rt'=>url()->current().'#userReview'])}}">login</a> in order to add a review</p>
                                @endif
                            </div>
                        </div>
                        <div id="description">
                            @isset($item->longDescription)
                                <h2 style="margin: 30px 0 19px 0;">Description</h2>
                                <div>
                                    {!! $item->longDescription->long_description !!}
                                </div>
                                @else
                                <h2 style="margin: 30px 0 19px 0;">No description available..</h2>

                            @endisset

                        </div>
                    </div>
                </div>
                <div class="d-grid relatedProducts">
                    <div class="innerRelatedProducts">
                        <div class="threeDTitle allCentered" style=" position: relative;">
                            <img src="{{img('_img/layout/titleBarGrey.png')}}" alt=""
                                 style="width: 100%; max-width: 224px;  position: relative;top: -10px;">
                            <h2 class="h5 text-center">
                                <span>Related Products</span>
                                <div class="shadowTringle" id="sta"></div>
                                <div class="shadowTringle" id="stb"></div>
                            </h2>
                        </div>
                    </div>
                    @if(count($item->relatedProducts))
                        <div style="background-color: #ffffff; padding: 10px;" class="f-row">
                            @foreach ($item->relatedProducts as $frameItem)
                                <div class="col-sm-6 col-md-3" style="cursor: pointer;">
                                    @include('items.frame-item',['noSlideMode'=>true])
                                </div>
                            @endforeach
                        </div>

                    @else
                        <p class="text-center h2 allCentered"> No Related Products.. </p>
                    @endif
                </div>
            </main>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function tpl() {
            shopAppOBJ.data.rating = 3;
            shopAppOBJ.methods.buyNow = function (e) {
                addToCartEventJQ.call(this.$refs.addToCart,e);
                window.location = BASE_URL + '/cart';
            }
        }

        function tplJQUI() {
            $('#publicTabs').tabs().removeClass('ui-widget ui-widget-content ui-widget-header ui-tabs-panel');
            $('[role="tablist"]').removeClass('ui-widget ui-widget-content ui-widget-header ui-tabs-panel ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix');

        }

        function tplFlickJQ() {
            $('.productImgStage .carousel-main').width($('.productImages').width() - 70);
            $('.productImgStage .carousel-main-nav').width($('.productImages').width() - 70);
            $(window).on('resize', function () {
                $('.productImgStage .carousel-main').width($('.productImages').width() - 70);
                $('.productImgStage .carousel-main-nav').width($('.productImages').width() - 70);

            });
            $('.carousel-main').flickity({
                pageDots: false,
                imagesLoaded: true,
                "prevNextButtons": false
            });
            /*
            // 2nd carousel, navigation
                            $('.carousel-nav').flickity({
                                asNavFor: '.carousel-main',
                                contain: true,
                                pageDots: false
                            });*/
        }
    </script>
@endsection
@section('style')
    <style>
        .ui-widget-content a {
            color: #007bff;
        }
        .frameMy {
            top: 50px;
            left: 38px;
        }

        @media (max-width: 765px) {
            .frameMy {
                top: 11px;
                left: 14px;
            }
        }

        .relatedProducts .dragItem {
            width: initial;
        }

        .relatedProducts .frameItem > h3, .relatedProducts .frameItem > .frameItemTitle {
            word-wrap: break-word;
            overflow: hidden;
        }

        .innerRelatedProducts {
            height: 39px;
            background-color: #eeeeee;
            position: relative;
            border-bottom: 3px solid #c9c9c9;
        }

        .innerRelatedProducts .threeDTitle h2 {
            height: 100%;
            display: block;
            position: absolute;
            top: 5px;
        }

        @media (min-width: 810px) {
            .innerRelatedProducts .threeDTitle {
                max-width: 203px;
                margin-left: 24px;
            }

        }

        @media (max-width: 1013px) {

        }

        .SiteRouteWay > .sectionA {
            padding: 0;
        }

        .SiteRouteWay {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .orderCateBy, .grid-order {
            display: none;
        }

        /*carousel*/

        .itemStage .carousel-cell {
            width: 100%;
            height: 400px;
            margin-right: 10px;
            border-radius: 5px;
            counter-increment: carousel-cell;
        }

        .itemStage .carousel-nav .carousel-cell {
            height: 80px;
            width: 100px;
            border: 3px inset transparent;
        }

        .itemStage .carousel-nav .carousel-cell:before {
            font-size: 50px;
            line-height: 80px;
        }

        .itemStage .carousel-nav .carousel-cell.is-nav-selected {
            border: 3px inset #F52323;
            overflow: hidden;
        }

    </style>
@endsection
