@extends('layouts.master')
@section('content')

    @include('inc.main-slide')
    <div class="home_page" style="z-index: 1;">
        <h1 class="d-none">Home</h1>
        <main class="home_page_grid" id="app">
            <section class="featured" id="featured">
                <div class="featuredTitle">
                    <h2>FEATURED</h2>
                    <div class="navgiateSlide">
                        <span class="back">&lt;</span>
                        <span class="forward">&gt;</span>
                    </div>

                </div>
                <div class="itemsFrame">
                    @foreach ($lists['featured'] as $cubeItem)
                        @isset($cubeItem->id,$cubeItem->entityItem)
                            @php($cubeItem = $cubeItem->entityItem)
                            <div is="frame-item" :product='{!! $cubeItem !!}' inline-template>
                                <div class="frameItem gallery-cell carousel-cell"
                                     onclick="window.location = '{{url("$cubeItem->base_url$cubeItem->url")}}'">
                                    <div class="frameItemOverflow">
                                        <img class="Sirv" data-src="{{img("_img/{$cubeItem->img_path}/$cubeItem->main_img")}}"
                                             alt="{{$cubeItem->title??$cubeItem->name}}">
                                    </div>
                                    <h3 class="frameItemTitle">{{$cubeItem->title??$cubeItem->name}}</h3>
                                    <div class="frameItemPrices">
                                        <span style="color: #d70a0a">${{$cubeItem->price}}</span>
                                        @isset($cubeItem->prev_price)<span
                                                style="text-decoration: line-through;">${{$cubeItem->prev_price}}</span>@endisset
                                    </div>
                                    <a class="allCentered  addToCartB" @click="addToCartEvent" ref="addToCart" data-product='{!! $cubeItem !!}' data-toggle="modal" data-target="#product_view"
                                       :data-id="{!! $cubeItem->id !!}">
                                        <div class="allCentered">
                                            <i class="fa fa-cart-plus text-white"></i>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        @endisset
                    @endforeach

                </div>

            </section>
            <section class="trending">
                <h2>TRENDING NOW</h2>
                @php($tabs = [ 'man', 'women', 'kids', 'accessories', ])
                <ul>
                    @foreach($tabs as $ind => $tab)
                        <li v-on:click="selectedTag" @if(!$ind) class="trendActive"
                            @endIf data-tag="{{$tab}}">{{$tab}}</li>
                    @endforeach
                </ul>
            </section>

            <div class="newProducts">
                <h2 class="newProductsTitle">NEW PRODUCTS</h2>
                <div class="itemDragSlider carousel-cell">

                    <section class="itemsDragWrapper">
                        <div class="main-carousel itemsDrag">

                            @foreach ($frameItems as $frameItem)
                                @include('items.frame-item',['noSlideMode'=>true])
                            @endforeach
                        </div>
                    </section>
                    <div class="dragControl">
                        <input type="range" class="mainRange" id="controlCarousel" value="0" min="0" max="">
                    </div>
                </div>

            </div>
            <div class="trendingItems">
                <div class="cate-items">{{-- animated-loop--}}
                    @verbatim
                        <ul class="grid-items-4" v-if="items && items.length && itemsAvail">
                            <cate-item-r v-for="item in items" :key="item.id" :it="item"></cate-item-r>
                        </ul>
                        <h2 style="text-align: center; color: grey; text-transform: uppercase; padding: 30px 10px;"
                            v-else> no products available</h2>
                    @endverbatim
                </div>
            </div>

        </main>

    </div>

@endsection
@section('script')
    <style>
        @media (max-width: 810px) {

            .mainSlidePImgFrame {
                grid-row: 2;
            }

            #mainSlideItem1 p, #mainSlideItem1 .p {
                grid-row: 3;
            }

/*            .mainSlidePImgFrame img {
                min-width: 67%;
            }*/
        }

        @media (min-width: 810px) {
            #mainSlider.beforeLoad{
                max-height: 500px;
            }
            .mainSlidePImgFrame {
                grid-row: span 2;
            }

            #mainSlideItem1 p, #mainSlideItem1 .p {
                grid-row: 2;
            }
        }
    </style>
    <script defer async>
        function tpl() {
            window.items = {!! $cateItems !!};
            shopAppOBJ.data.items = window.items;
            shopAppOBJ.data.itemsAvail = true;
            shopAppOBJ.methods.selectedTag = function (e) {
                $('.animated-loop').children().addClass('animate-loaded-hide');
                $.ajax({url: url + '/home/tags/' + $(e.target).data('tag')}).then(function (res) {
                    shopAppOBJ.data.items = res;
                    shopAppOBJ.data.itemsAvail = true;
                    Vue.nextTick(function () {
                        var $els = document.querySelectorAll('.animate-loaded-hide');
                        if($els.length) shopAppOBJ.methods.animatedLoop($els[0]);
                        reloadSirv();
                    });

                }, function (e) {
                    shopAppOBJ.data.itemsAvail = false;
                    if($els.length) shopAppOBJ.methods.animatedLoop($els[0]);
                });
                $('.trending ul li').removeClass('trendActive');
                $(e.target).addClass('trendActive');
            };

        }

        function tplJQ() {

        }

        function tplFlick() {
/*            var $mainSliderV = document.getElementById('mainSlider');
            new Flickity($mainSliderV, {
                "imagesLoaded": true,
                "pageDots": false,
                "autoPlay": 4000,
                "lazyLoad": true,
                "bgLazyLoad": true
            });
            $mainSliderV.classList.add('show');
            $mainSliderV.classList.remove('.beforeLoad');*/
        }

        function tplFlickJQ() {
            // home page
            var $featured = $('.featured');
            $featured.find('.back').on('click', function () {
                $featured.children('.itemsFrame').flickity('previous');
            });
            $featured.find('.forward').on('click', function () {
                $featured.children('.itemsFrame').flickity('next');
            });
            $featured.find('.itemsFrame').flickity({fullscreen: true, groupCells: false, pageDots: false,"lazyLoad": true});

            setTimeout(function () {
                var $mainCarou = $('.itemsDrag'), $controlCarousel = $('#controlCarousel');
                $mainCarou.flickity({ "groupCells": true , "pageDots": false,"prevNextButtons": false,"lazyLoad":true});
                $controlCarousel.attr('max', ($('.itemDragSlider .flickity-slider').children().length - 2) * 255);
                $controlCarousel.on('input', function (e) {

                    $mainCarou.find('.flickity-slider').css('transform', 'translateX(-' + e.target.value + 'px)');
                });
                $('#mainSlider .gallery-cell').css('display','block');
            })
            // !home page

        }
    </script>

@endsection