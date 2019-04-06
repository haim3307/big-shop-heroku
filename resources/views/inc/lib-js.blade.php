<script>
    //lib-js
    window.onload = function () {
        updateCartedButtons();
    };
    String.prototype.capitalize = function () {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };

    function updateCartedButtons(e) {
        //console.log('--------update cart-----------');
        var dq = document.querySelectorAll;
        document.querySelectorAll('.addToCartB,.storeBTN').forEach(function ($el) {
            $el.removeAttribute('disabled');
        });
        document.querySelectorAll('.addToCartB .btnTitle').forEach(function ($el) {
            $el.innerHTML = 'Add To Cart';
        });
        for (var index in window.shopAppOBJ.data.cartItems) {
            var $mainBTN = document.querySelectorAll('.addToCartB[data-id],.addToCartB[data-product],.addToCartProductPage');
            var $toDisable = [];
            $mainBTN.forEach(function ($findBtn) {
                if ($findBtn.dataset.id == window.shopAppOBJ.data.cartItems[index].id) {
                    $toDisable.push($findBtn);
                }
            });
            console.log(new Date().toLocaleTimeString(),'toDisable:',$toDisable,$mainBTN);

            function disable($btnI) {
                console.log('$btnI',$btnI);
                if ($btnI.querySelectorAll('.buyNow').length) $btnI = document.querySelector('.addToCartProductPage');
                $btnI.setAttribute('disabled', 'disabled');
                var $btnTitle = $btnI.getElementsByClassName('btnTitle');
                if ($btnTitle.length) $btnTitle[0].innerHTML = '<strong>In cart</strong>';
            }

            if ($toDisable.length) $toDisable.forEach(disable);

        }
    }


    function updateCartedButtonsJQ(e) {

        $('.addToCartB').removeAttr('disabled');
        $('.addToCartB .btnTitle').html('Add To Cart');
        for (var index in window.shopAppOBJ.data.cartItems) {
            var $mainBTN = $('.addToCartB[data-id=' + window.shopAppOBJ.data.cartItems[index].id + ']');
            var $btn = $mainBTN.find('.buyNow').length ? $mainBTN.find('.addToCartProductPage') : $mainBTN;
            $btn.attr('disabled', 'disabled');
            $btn.children('.btnTitle').html('<strong>In cart</strong>');
        }
    }

    load.js('https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js')
        .then(function () {
            //console.log('1.jquery here');
            load.js('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js').then(function () {
                load.js('https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js').then(function () {
                    jQuery(function ($) {
                        tplJQBT();
                        @if(Session::has('ms')) $('#addedToCartModal').modal('show'); @endif
                        $('#translateLi>a').on('click',function (e) {
                            //e.preventDefault();
                        });
                        $('#translateLi').find('i.fa-language,i.fa-angle-down').on('click',function (e) {
                            e.preventDefault();
                            $("#google_translate_element .goog-te-menu-value > span").click();
                        });
                        $('.quickViewB').on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var $el = $(this);
                            var id = $el.data('id');
                            var categoryId = $el.data('category-id');
                            var $btn = $el;
                            var product = $btn.data('product') || $btn.get()[0].dataset;
                            //console.log(product);
                            product.quantity = product.quantity ? Number(product.quantity) : 1;
                            $('#product_view').modal('show');
                            shopAppOBJ.data.quickProduct = product;
                        });
                    });
                });
            });
            load.js('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js').then(function () {
                {!! strip_tags(Toastr::render()) !!}
            });
            jQuery(function ($) {
                tplJQ();
                load.js('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js').then(function () {
                    var $footerCarousel =  $('#footer-carousel').owlCarousel({
                        loop:true,
                        margin:10,
                        nav:true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:3
                            },
                            1000:{
                                items:4
                            }
                        },
                        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                        dots: false

                    });

                    var $mainSlideOwl =  $('#mainSlideOwl').owlCarousel({
                        loop:true,
                        animateOut: 'slideOutDown',
                        animateIn: 'flipInX',
                        items:1,
                        lazyLoad:true,
                        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                        nav:true,
                        dots: false,
                        autoplayTimeout:5000,
/*
                        autoplay: true
*/
                    });
                    $mainSlideOwl.on('changed.owl.carousel',function () {
                        setTimeout(function () {
                            $mainSlideOwl.find('.owl-item.active img').addClass('Sirv');
                            reloadSirv();
                        })
                    });
                    $('.owl-hide').removeClass('owl-hide');
                    $('#postcarousel-DU3uE .owl-carousel').owlCarousel({
                        margin:10,
                        nav:true,
                        responsive:{
                            0:{
                                items:1
                            },
                            600:{
                                items:2
                            },
                            1000:{
                                items:2
                            }
                        },
                        navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
                        dots: false
                    });

                });

/*
                $('.addToCartB').on('click', addToCartEvent);
*/

                load.js('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js')
                .then(function () {
                    tplJQUI();

                })
                .catch(function (e) {
                    console.log(e);
                    console.log('Oh no, epic failure!1');
                });
                $('.topBarNav .dropdown-menu').on('click', function (e) {
                    e.stopPropagation();
                });
                $('#allSiteSearch').on('keyup', function (e) {
                    $.getJSON(BASE_URL + '/api/entities/' + e.target.value).then(function (res) {
                        shopAppOBJ.data.autoCompleteFrontList = res;
                    }, function (e) {
                        shopAppOBJ.data.autoCompleteFrontList = [];
                    });
                });
                $('.addToWishB').on('click', function (e) {
                    var wishId = $(this).data('wish-id'), wishUrl = $(this).data('wish-url');
                    if(loggedIn == 0) {$('.signToWish[data-wish-id='+wishId+']').removeClass('fade').delay(1000);
                    setTimeout(function () {
                        $('.signToWish[data-wish-id='+wishId+']').addClass('fade')
                    },1000); return;}
                    $.ajax({
                        url: BASE_URL + '/user/wishlist',
                        method: 'POST',
                        data: {
                            wish_id: wishId,
                            wish_url: wishUrl
                        }
                    }).then(function (res) {
                        window.location.reload();
                    });
                });
                setTimeout(function () {
                    $('.addedToWishMessage').fadeOut(500);
                },1000);
                $('.removeFromList').on('click', function (e) {
                    e.preventDefault();
                    var wishId = $(this).data('wish-id');
                    $.ajax({
                        url: BASE_URL + '/user/wishlist/' + wishId,
                        method: 'DELETE',
                    }).then(function (res) {
                        if (res == 1) {
                            $('[data-wish-id=' + wishId + ']').parent().parent().remove();
                        }
                    });
                });
            });
            load.js('https://cdnjs.cloudflare.com/ajax/libs/flickity/2.1.2/flickity.pkgd.min.js')
                .then(function () {
                    load.js('https://unpkg.com/flickity-bg-lazyload@1/bg-lazyload.js').then(function () {
                        jQuery(function ($) {
                            tplFlick();
                        });

                    });
                    jQuery(function ($) {

                        tplFlickJQ();

                        (function mainJs() {
                            $('.carousel-cell').css('opacity', '1');

                            function toggleThirdNav(e) {
                                if (window.scrollY > 200) $('.thirdNav').addClass('fixedBar');
                                else $('.thirdNav').removeClass('fixedBar');
                            }
                            var $backToTop = $('.backToTop');
                            $backToTop.on('click',function (e) {
                                e.preventDefault();
                                $('html,body').animate({
                                    scrollTop: 0
                                },500);
                            });
                            function toggleBackToTop(e) {
                                if($(this).scrollTop() > 300){
                                    $backToTop
                                        .css({'position':'fixed',top:0,height:'100%',margin:'auto',right:0});
                                    $backToTop.children('img').css({'position':'absolute',top:0,bottom:0,margin:'auto',right:'10px','border-radius':'100%'})
                                }else{
                                    $backToTop
                                        .css({'position':'initial',top:0,height:'100%',margin:'auto',right:0});
                                    $backToTop.children('img').css({'position':'initial',top:0,bottom:0,margin:'auto',right:0,'border-radius':'initial'});
                                }
                            }

                            toggleThirdNav();
                            toggleBackToTop();
                            $(window).on('scroll',function(e){
                                toggleThirdNav(e);
                                toggleBackToTop(e);
                            });
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });

                            jQuery.prototype.menuBoard = function ($menuButtons) {
                                var _self = this;
                                $menuButtons.on('mouseenter', function (e) {
                                    //$menuButtons.removeClass('menuBtnActive');
                                    if (window.innerWidth > 910) {
                                        var boardId = $(this).data('boardId');
                                        if (boardId) {
                                            //$(this).addClass('menuBtnActive');
                                            _self.html($('div[data-board-id="' + boardId + '"]').html());
                                            _self.show();
                                        } else _self.hide();
                                        _self.on('mouseleave', function(e) {
                                            //$(this).removeClass('menuBtnActive');
                                            _self.hide();
                                            /*						$(this).on('mouseleave',function (e) {
                                                                        $(this).removeClass('menuBtnActive');
                                                                        $(this).off('mouseleave');
                                                                    });*/
                                        });
                                    }
                                });
                            };
                            $('.menuBoard').menuBoard($('.mainNav ul li'));
                            $(window).on('resize', function () {
                                if (window.innerWidth >= 1112) $('.mainNav').children('ul').css('display', 'flex');
                                else $('.mainNav').children('ul').css('display', 'grid');
                            });

                            let fc = true;
                            $('#mobileHamburger').on('click', function (e) {
                                if (fc) {
                                    $(this).siblings('.mainNav').children('ul').removeClass('hideMenu').hide().slideToggle();
                                    fc = false;
                                }
                                else {
                                    $(this).siblings('.mainNav').children('ul').slideToggle();
                                }

                            });
                            //dropdown(jQuery, this);
                            $(window).on('load', function () {
                                // noinspection JSPotentiallyInvalidConstructorUsage

                                $(window).on('resize', function () {
                                    if (window.innerWidth >= 1111) {
                                        $('#controlCarousel').attr('max', ($('.itemDragSlider .flickity-slider').children().length - 2) * $('.dragItem').width() + 10);
                                    } else {
                                        $('#controlCarousel').attr('max', (($('.itemDragSlider .flickity-slider').children().length - 2) * $('.dragItem').width()) + 250);
                                    }

                                });

                            });
                        })();
                        for (var addonJQ in addonsJQ) if (typeof addonsJQ[addonJQ] == 'function') addonsJQ[addonJQ]();


                    });


                }).catch(function (e) {
                console.log(e);
                console.log('Oh no, epic failure!');
            });

        });
    /*!lib-js*/
</script>