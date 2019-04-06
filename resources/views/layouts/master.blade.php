<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="{{$metaDesc??$defaultMetaDesc}}">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="theme-color" content="#FE1F1F"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="keywords" content="life style store,sport,camping,playground,JavaScript">
{{--
    <link rel="manifest" href="{{asset('/manifest.webmanifest')}}">
--}}
    {{--global lists--}}
    @inject('masterLayout','App\Services\MasterData')
    {{--!global lists--}}
    @if(isset($title))
        @isset($page->title)
            <title>{{$title.ucwords($page->title)}}</title>
        @else
            <title>{{$title}}</title>
        @endisset
    @else
        <title>@yield('title')</title>
    @endif

    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>
    <script src="https://scripts.sirv.com/sirv.js" defer></script>
    <script>
			function ready(fn) {
				if (document.readyState != 'loading') {
					fn();
				} else if (document.addEventListener) {
					document.addEventListener('DOMContentLoaded', fn);
				} else {
					document.attachEvent('onreadystatechange', function () {
						if (document.readyState != 'loading')
							fn();
					});
				}
			}
    </script>
    <script>
			var localList = (JSON.parse(localStorage.getItem('cartItems')) || []).filter(function (item) {
				return item.id;
			}).map(function (item) {
				if (item.main_category && typeof item.main_category === 'string') item.main_category = JSON.parse(item.main_category);
				return item;
			});
			localStorage.setItem('cartItems',JSON.stringify(localList));
    </script>
    @include('inc.load-script')
    <script>
			function tpl() {
			}

			function tplVue() {
			}

			function tplJQ() {
			}

			function tplJQBT() {
			}

			function tplJQUI() {
			}

			function vueShopCart() {
			}

			function tplFlick() {

			}

			function tplFlickJQ() {

			}
            function reloadSirv() {
                Sirv.start();
			}
            //reloadSirv();
			var addonsJQ = [];// array of own plugin functions
    </script>
    <script>
			window.url = '{{remove_http(url(''))}}';
			window.token = '{{ csrf_token() }}';
			window.categoriesWithFilters = {!! \App\Category::with('filters')->get() !!};
			console.log(categoriesWithFilters);
			window.BASE_URL = '{{remove_http(url(''))}}'.replace('index.php','');
			window.loggedIn = '{{Auth::check()?1:0}}';
            @if(Session::has('clear_cart')) window.clearCart = true; @endif

    </script>

    <script>
			var shopAppOBJ = {el: '#shopApp', data: {}, methods: {}, computed: {}, filters: {}};
    </script>

    {{--
        <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    --}}

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{asset('css/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles1.min.css')}}">
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://unpkg.com/flickity@2.1.1/dist/flickity.min.css">
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.min.css">

    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" id='exo-2-css'
          href='//fonts.googleapis.com/css?family=Exo+2%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;subset=latin&#038;ver=2.6.17'
          type='text/css' media='all'/>
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" id='exo-css'
          href='//fonts.googleapis.com/css?family=Exo%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;subset=latin-ext%2Clatin%2Cvietnamese&#038;ver=2.6.17'
          type='text/css' media='all'/>
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" defer></script>
    <script src="{{asset('js/lib/http_use.fontawesome.com_07b0ce5d10.js')}}" defer async></script>

    <style>
        html{overflow-x: hidden;}
        ::-webkit-scrollbar { width: 0 !important }
        .carousel-cell {
            opacity: 0;
            transition: 1.5s opacity;
        }

        #page {
            padding-top: 30px;

        }
    </style>
    <style>
        #mainSlideOwl{
            /*transition: 0.7s all;*/
            height: auto;
        }
        #mainSlideOwl.owl-hide{
            height: 600px;
            display: block;
            opacity: 1 !important;
            background: url({{asset("_img/layout/Facebook-1s-200px.gif")}}) no-repeat center center;
        }
        #mainSlideOwl.owl-hide::after{
            content: '<h1>loading</h1>';
        }
        #mainSlideOwl .owl-item.loading{
/*            min-height: 150px;
            background: url({{asset("_img/layout/ajaxloader.gif")}}) no-repeat center center;*/
        }
        .owlHomeItem p a, .owlHomeItem .p a ,.shopNow{
            margin-top: 31px;
            border-radius: 10px;
            background-color: #d70a0a;
            color: white;
            text-decoration: none;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: distribute;
            justify-content: space-around;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            width: 163px;
            height: 45px;
        }
        @media (min-width: 992px) {
            .owlHomeItem .container-1112{
                display: grid;
                grid-template-rows: 50px 1fr;
                grid-template-columns: 1fr 1fr;
                grid-row-gap: 22px;
                direction: rtl;
                padding: 55px 0;
                min-height: 600px;
            }
            #mainSlideOwl{
                transform: translateY(27px) scaleY(1.093);
            }
        }
        .img{
            display: initial;
            width: initial;
        }
        .owl-carousel .owl-item .mainSlidePImgFrame img {
            display: inline-block;
            width: initial;
        }
        @media(max-width: 992px) {
            #mainSlideOwl.owl-carousel .img-fluid{
                max-height: 30vh;
                width: auto;
                max-width: initial;
            }

        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head')
    @stack('styles')
    <style type="text/css">
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }

        body {
            top: 0 !important;
        }

        .goog-te-gadget-icon {
            display: none !important;
        }

        .goog-te-menu-value {
            display: flex;
            flex-flow: row-reverse;
        }
    </style>
    <style>
        .animate-loaded{
            display: block !important;
        }
        .animate-loaded-hide{
            display: none !important;
        }
    </style>
</head>
<body class="kc-css-system" style="top: 0 !important;">
<div class="all_site" id="shopApp">
    @include('layouts.header')
    <main style=" overflow: hidden;">
        @yield('content')
    </main>
    @include('layouts.footer')
    <added-to-cart-modal :product="product" :message="'{{Session::get('ms')}}'"></added-to-cart-modal>
    <quick-product-view-modal :product="quickProduct"></quick-product-view-modal>

</div>
@if(Request::server('HTTP_HOST') != 'localhost:8000')
    {{--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://use.fontawesome.com/07b0ce5d10.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>--}}

@endif
<script>
	function onImgLoad(selector, callback) {
		$(selector).each(function () {
			if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
				callback.apply(this);
			}
			else {
				$(this).on('load', function () {
					callback.apply(this);
				});
			}
		});
	}

</script>
@yield('style')
<style>
    .topBarNav a:hover {
        color: black !important;
    }
</style>
@stack('styles')
@stack('scripts')

<style>
    .goog-te-gadget {
        display: block !important;
    }
</style>
<style>
    .itemMessage{
        position: absolute;top: {{$top??0}}; right: {{$right??0}}; z-index: 100; padding: 10px; color: white; background-color: rgba(111,111,111,0.7);
    }
    .quickViewB{
        height: 46px;
        width: 46px;
        line-height: 44px;
        background: transparent;
        color: #fff;
        font-size: 16px;
        display: inline-flex;
        text-align: center;
        border: 0 !important;
        margin: 0;
        align-items: center;
        justify-content: center;
        border-radius: 100%;

    }
    .quickViewB:hover{
        border-radius: 100%;
    }

    .quickViewB i{
        position: relative;
        top: -3px;
    }
    .quickViewWrap{
        background-color: rgba(191, 13, 13, .75);
        border-radius: 100%;
    }
    .pagination {
        display: grid;
        grid-template-columns: repeat(auto-fill, 72px);
    }

    .page-item.active .page-link {
        background-color: #F44336;
        border-color: #F44336;
        color: white;
    }

    .page-item .page-link {
        color: #F44336;
    }

    .page-item.disabled .page-link {
        opacity: 0.5;
    }

    .pagination li span, .pagination li a {
        padding: 1.2rem;
        text-align: center;
    }
</style>
@include('inc.load-vue')
@yield('script')
@include('inc.lib-js')
</body>
</html>