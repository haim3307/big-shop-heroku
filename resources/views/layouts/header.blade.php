<header class="mainHeader">
    <div class="container-1112">
        <div class="menuBoard">

        </div>

        <div data-board-id="brands" class="stockMenuBoards">
            <div class="d-grid grid-col-4" style="    height: 100%;">
                {{--                <div class="carousel-cell d-grid align-items-center" style="padding: 37px;min-height: 100px;"> </div>
    --}}
                @foreach($masterLayout->brands as $brand)
                    <a style="padding: 20px 37px;" class="allCentered"><img class=""
                                                                            style="max-height: 50px; width: 100%"
                                                                            src="{{img('_img/brands/'.$brand['main_img'])}}"></a>
                @endforeach
            </div>
        </div>
        <div class="mainLogo"><a href="{{url('')}}"><img src="{{img('_img/logo.png')}}" alt=""></a></div>
        <div id="mobileHamburger" class="allCentered">
            <i><img style="height: 40px;
    padding-top: 2px;" src="{{img('_img/header/bars.svg')}}" alt=""></i>
        </div>
        <nav class="searchAndShare">
            <ul class="" style="margin-right: 10px;">
                <li><a href="https://twitter.com/BigShop14"><img src="{{img('_img/header/twiter.png')}}" alt=""></a></li>
                <li><a href="https://www.facebook.com/Big-Shop-2019449578308589/?modal=admin_todo_tour"><img src="{{img('_img/header/facebook.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{img('_img/header/Dribbble.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{img('_img/header/last-fm.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{img('_img/header/linked-in.png')}}" alt=""></a></li>
                <li><a href=""><img src="{{img('_img/header/tumblir.png')}}" alt=""></a></li>

            </ul>
            <div class="input-group2 d-flex align-items-center" style="position: relative; flex: 1;">
                @push('styles')
                    <style>
                        #allSiteSearch {
                            padding: 5px 9px;
                            border-radius: 20px;
                            margin-bottom: 3px;
                            max-height: 82vh;
                            width: 100%;
                        }

                        #allSiteSearch + i {
                            height: 32px;
                            width: 32px;
                            border: none;
                            cursor: pointer;
                            color: white;
                            position: absolute;
                            right: 9px;
                            bottom: 7px;
                        }

                    </style>
                @endpush
                <input type="text" placeholder="Search" id="allSiteSearch">
                <i class="fa fa-search allCentered-i" style=""></i>
                <auto-complete-menu :list="autoCompleteFrontList"></auto-complete-menu>
            </div>

        </nav>
        @include('layouts.main-nav')

        <nav class="thirdNav">

            <nav class="topBar d-grid grid-col-12 align-items-center text-center" style="height: 100%">
                <div class="g-col-12 g-col-lg-4" style="color: #878c94;     padding-bottom: 5px;">
                    @if($user = Auth::user())
                        Welcome back
                        @if($user->isAdministrator())
                            Admin -
                        @endif
                        {{ucwords($user->name)}}
                    @endif
                </div>

                <div class="g-col-12 g-col-lg-8" style="width: 100%;
                                                height: 100%;
                                                display: flex;
                                                align-items: center;
                                                justify-content: flex-end;
                ">
                    <ul class="topBarNav fade">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="false"> <i class="fa fa-usd mr-1"></i><span
                                        class="d-none d-sm-inline-block">USD</span><i
                                        class="fa fa-angle-down ml-2 mr-2 d-none d-sm-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu w-100" role="menu">
                                <li class=""><a href="#"><i class="fa fa-usd mr-1"></i>USD</a>
                                </li>
                            </ul>
                        </li>
                        <li id="translateLi">
                            <a style="cursor: pointer;" href="javascript:void(0)" class="d-sm-flex align-items-center">
                                <i class="fa fa-language ml-2" style="position: relative; top: -3px;"></i>
                                @push('scripts')
                                    <script async defer>

                                        function googleTranslateElementInit() {
                                            new google.translate.TranslateElement({
                                                pageLanguage: 'en',
                                                includedLanguages: 'en,es,fr,ru',
                                                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                                            }, 'google_translate_element');
                                            //document.querySelector('.topBarNav').classList.add('show');

                                            document.getElementsByClassName('topBarNav')[0].classList.remove('fade');

                                        }

                                        load.js('//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit');
                                    </script>
                                    <style>
                                        .goog-te-menu-value {
                                            display: flex !important;
                                            flex-flow: row-reverse;
                                            align-items: center;
                                            position: relative;
                                            top: -3px;
                                        }

                                        .goog-te-menu-value span {
                                            color: #878c94 !important;
                                            padding-right: 10px;
                                        }
                                        .goog-te-menu-value span:nth-of-type(2) {
                                            display: none !important;
                                            color: #878c94 !important;
                                        }

                                        .goog-te-gadget-simple {
                                            background-color: transparent !important;
                                            border: 0 !important;
                                        }
                                        .goog-te-menu-value span[aria-hidden="true"]{
                                            display: none;
                                        }
                                        @media (max-width: 576px) {
                                            #google_translate_element {
                                                position: absolute;
                                                visibility: hidden;
                                            }
                                        }
                                    </style>
                                @endpush
                                <div id="google_translate_element"></div>
                                <i
                                        class="fa fa-angle-down ml-2 mr-2 d-none d-sm-inline-block"></i>
                            </a>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="false"> <i class="fa fa-user mr-1"></i><span
                                        class="d-none d-sm-inline-flex align-items-center"><span>My Account</span><i
                                            class="fa fa-angle-down ml-2 mr-2"></i></span> </a>
                            <ul class="dropdown-menu w-150" role="menu">
                                @if(!Auth::check())
                                    <li><a href="{{url('login')}}">Login</a></li>
                                    <li><a href="{{url('register')}}">Create Account</a></li>
                                @elseif($user->allowedCMS() && !request()->iframe_mode)
                                    <li><a href="{{url('cms/')}}">CMS</a></li>
                                @else
                                    <li><a href="{{url('user/profile')}}">My Profile</a></li>
                                @endif
                                <hr style="margin: 0">
                                <li><a href="{{url('cart')}}">My Cart</a>
                                </li>

                                <li><a href="{{url('user/wishlist')}}">Wishlist</a>{{-- (5)--}}
                                </li>
                                <li><a href="{{url('user/orders')}}">My Orders</a>
                                </li>

                                @auth
                                    <li>
                                        <a>
                                            <form action="{{route('logout')}}" method="POST">
                                                {{csrf_field()}}
                                                <input class="d-none" type="submit" name="" id="logout">
                                                <label for="logout">Logout</label>
                                            </form>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </li>
                        <li class="dropdown shopCartMenu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                               data-close-others="false">
                                <i class="fa fa-shopping-basket mr-1"></i>
                                <span class="d-none d-sm-inline-block">
                                Cart<sup class="text-primary" v-text="'('+cartItems.length+')'"></sup>
                                </span>

                                <span class="redOpenArrow" style="">
                                     <img src="{{img('_img/header/arrow-down.png')}}" alt="">
                                </span>
                            </a>
                            <ul class="dropdown-menu cart w-250" role="menu">
                                <li>
                                    <div class="cart-items">
                                        <cart-list :cart-items="cartItems"></cart-list>
                                    </div>
                                </li>
                                <li>
                                    <div class="cart-footer">
                                        <a href="{{url('/cart')}}" class="pull-left"><i
                                                    class="fa fa-cart-plus mr-1"></i>View
                                            Cart</a>
{{--                                        <a href="{{url('/checkout')}}" class="pull-right"><i
                                                    class="fa fa-shopping-basket mr-1"></i>Checkout</a>--}}
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>

            </nav>
        </nav>
        <div class="leftPaddingHeader">
            <div class="leftArea"></div>
        </div>
    </div>

</header>

{{--
                            <sup class="text-primary">(3)</sup>
--}}
{{--
                                <i class="fa fa-angle-down ml-5"></i>
--}}
{{--<i class="fa fa-shopping-basket mr-1"></i>--}}