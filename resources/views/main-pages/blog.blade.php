@extends('layouts.master')
@section('head')
    <link rel='stylesheet' id='exgym-style-css'  href={{asset('css/specialTemp.css')}} type='text/css' media='all' />

    <style>
        .widget-woof .woof_container .widget h4, .widget .widget-title, .widget .widget-woof .woof_container h4, .widget .widgettitle {
            font-size: 18px;
            line-height: 22px;
            font-weight: 700;
            padding: 0 0 21px 0;
            margin: 0;
            margin-bottom: 32px !important;
            color: #000;
            font-family: Exo\ 2;
            text-transform: uppercase;
            border-bottom: 1px solid #ececec;
            position: relative;
        }
    </style>

@endsection
@section('content')
    <div id="page" class="hfeed site page-home-1" style="background-color:#fff;">
        <section id="main" class="site-main">
            <section id="main-container" class="d-flex justify-content-center inner mainright">
                <div class="f-row container-1112">
                    @include('blog.side-bar')


                    <div id="main-content" class="main-content col-sm-12 col-xs-12 col-lg-9 col-md-9">
                        <div id="primary" class="content-area">
                            <div id="content" class="site-content" role="main">

                                <div class="g-row" style="grid-gap: 20px;">
                                    @forelse($posts as $post)
                                        @include('items.post')
                                        @empty
                                        <h3 class="text-center g-col-12">No posts were found..</h3>
                                    @endforelse
                                </div>


                                <nav class="navigation paging-navigation clearfix" role="navigation">
                                    <h1 class="screen-reader-text">Posts navigation</h1>
                                    <div style="padding: 15px;">{!! $posts->render("pagination::bootstrap-4") !!}</div>

                                    <!-- .pagination -->
                                </nav>
                                <!-- .navigation -->

                            </div>
                            <!-- #content -->
                        </div>
                        <!-- #primary -->
                    </div>
                    <!-- #main-content -->

                </div>
            </section>
        </section>
        <!-- #main -->
    </div>
@endsection
