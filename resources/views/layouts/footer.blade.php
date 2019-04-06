<footer  id="mainFooter" style="overflow:hidden;">
    {{--    @push('styles')
            <style>
                @media (max-width: 1112px) {
                    .footer-carousel{
                        width: 100vw;
                    }
                }
            </style>
        @endpush
        <style>
            @media (max-width: 1112px) {
                .footer-carousel{
                    width: 100vw;
                }
            }
        </style>--}}
    <div class="container-1112-footer">
        <section class="companiesSlider">
            <div class="carousel-cell owl-carousel owl-hide" id="footer-carousel"  style="overflow: hidden; max-width: 98vw;">

                @foreach ($masterLayout->brands as $brandItem)
                    <div class="carousel-cell d-flex justify-content-center align-items-center" style="padding: 10px;min-height: 100px;">
                        <img class="" style="max-height: 50px; " src="{{img('_img/brands/'.$brandItem['main_img'])}}">
                    </div>
                @endforeach
            </div>
            @push('styles')
                <style>
                    .owl-hide{
                        opacity: 0 !important;
                        transition: 0.7s all;
                    }
                    .owl-prev {
                        left: 5px;
                    }

                    .owl-next {
                        /*width: 15px;*/
                        right: 5px;
                    }
                    .owl-prev i, .owl-next i { font-size: 3em; color: #333;}
                    .owl-nav > button {
                        position: absolute;
                        background: hsla(0,0%,100%,.75) !important;
                        border: none;
                        top: 0;
                        bottom: 0;
                        width: 54px;
                        height: 54px;
                        border-radius: 50%;
                        margin: auto;
                        display: flex !important;
                        align-items: center;
                        justify-content: center;
                    }
                    .owl-nav > button:focus {
                        outline: 0;
                        box-shadow: 0 0 0 5px #19f;
                    }
                    .companiesSlider{
                        height: initial;
                        padding: 18px 0;
                        min-height: 136px;
                    }
                    #footer-carousel.owl-carousel .owl-item img {
                        display: block;
                        max-width: 100%;
                        width: initial;
                    }
                </style>
                @endpush
        </section>
        <div class="siteMap grid-items-3">

            <section class="WhoWeAre">
                <h3>Who We Are</h3>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of type and scrambled it to make a type specimen book. It has
                </p>
                <ul>
                    <li><i><img src="{{img('_img/Flag.png')}}" alt=""></i><span>Address 123, Country</span></li>
                    <li><i><img src="{{img('_img/iPad.png')}}" alt=""></i><span>(043) 875-9211</span></li>
                    <li><i><img src="{{img('_img/Mail.png')}}" alt=""></i><span>info@kopasoft.com</span></li>
                </ul>
            </section>
            <section class="Categories">

                <h3>Categories</h3>
                <ul>
                    @for ($x = 0; $x < 15; $x++)
                        <li class="text-capitalize"><a
                                    href="{{isset($masterLayout->allCategories[$x]->url)?url('shop/'.$masterLayout->allCategories[$x]->url):'#'}}"
                                    class="my-text-overflow d-block" style="    white-space: nowrap;
;max-width: 100px;">{{$masterLayout->allCategories[$x]->name??''}}</a></li>
                    @endfor
                </ul>

            </section>
            <section class="Tweets">
                <h3>Latest Tweet</h3>
                <ul>
                    <li><img src="{{img('_img/twitter.png')}}" alt="">
                        <p>Check out this great #themeforest item for you 'Simpler Landing</p>
                        <small>2 Hours ago</small>
                    </li>
                    <li><img src="{{img('_img/twitter.png')}}" alt="">
                        <p>Check out this great #themeforest item for you 'Simpler Landing</p>
                        <small>2 Hours ago</small>
                    </li>
                    <li><img src="{{img('_img/twitter.png')}}" alt="">
                        <p>Check out this great #themeforest item for you 'Simpler Landing</p>
                        <small>2 Hours ago</small>
                    </li>
                </ul>
            </section>
        </div>

    </div>
    <footer>
        <div class="container-1112-footer f-row align-items-center justify-content-center justify-content-md-between">
            <div class="copyRights">Copyrights. © {{date("Y")}} by HTProjects</div>
            <div class="f-row justify-content-center align-items-center">
                <ul class="f-row align-items-center justify-content-center">
                    @foreach ($masterLayout->menus['footer-nav']->items as $item)
                        @if($item)
                            <li>
                                <a href="{{url($item->calc_url)}}">{{ucwords($item->title)}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <a class="backToTop" href=""><img height="53" src="{{img('_img/back%20to%20top.png')}}" alt=""></a>

            </div>
        </div>
    </footer>
</footer>