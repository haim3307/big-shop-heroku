<nav id="sidebar" style="overflow-y: scroll; height: 100vh;">
    <!-- Sidebar Header -->
    <h1 style="text-align: inherit;padding: 13px 20px; " class="d-none d-lg-block text-white">Big Shop</h1>
    <hr style="border-top: 1px solid rgba(255,255,255,.1);">
    <!-- Sidebar Links -->
    <ul class="list-unstyled components">
        <li class="link {{ active('cms') }}">
            <a href="{{url('cms/')}}">
                <span class="fa fa-th" aria-hidden="true"></span>
                <span class="title">Management Panel</span>
            </a>
        </li>


        <li class="link {{ active('cms/category*') }}">

            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Categories</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-post">
                <li><i></i><a href="{{url('cms/category/create')}}">Create New</a></li>
                <li><i></i><a href="{{url('cms/category/')}}">Watch All Categories</a></li>
            </ul>

        </li>
        <li class="link {{ active('cms/product*') }}">

            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Products</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-post">
                <li><i></i><a href="{{url('cms/product/create')}}">Create New</a></li>
                <li><i></i><a href="{{url('cms/product/')}}">Watch All Products</a></li>
            </ul>

        </li>
        <li class="link {{ active('cms/page*') }}" id="pagesListLink">
            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Pages</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-pages">
                <li>
                    <i></i>
                    <a href="{{url('cms/page/all')}}">All Pages</a>
                </li>
                <li>
                    <i></i>
                    <a href="{{url('cms/page/create')}}">Create New</a>
                </li>
                <li class="f-row justify-content-between">
                    <span>
                        <i>
                        {{--<div class="led-green" style="position: relative;top: -2px;"></div>--}}
                         </i>
                    <a href="{{url('cms/page/home')}}">Home</a>
                    </span>
                    @include('cms.layouts.inc.is-core-badge',['navItem'=>(object)['is_core'=>1]])

                </li>
                @foreach(\App\Page::limit(10)->get()->except([4,9,5]) as $navItem)
                    <li class="f-row justify-content-between" title="{{ucwords($navItem->title)}}">
                        <span class="col-7 overflow-hidden">
                            <i>
                            {{--<div class="led-green" style="@if($navItem->active)background-color:#F00;@endif position: relative;top: -2px;"></div>--}}
                        </i>
                        <a class="my-text-overflow" href="{{url('cms/page/'.$navItem->url)}}">{{ucwords($navItem->title)}}</a>
                        </span>
                        @include('cms.layouts.inc.is-core-badge')
                    </li>
                @endforeach
            </ul>

        </li>
        <li class="link {{ active('cms/post*') }}" id="pagesListLink">
            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Posts</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-pages">
                <li>
                    <i></i>
                    <a href="{{url('cms/post/')}}">All Posts</a>
                </li>
                <li>
                    <i></i>
                    <a href="{{url('cms/post/create')}}">Create New</a>
                </li>
            </ul>

        </li>

        <li class="link {{ active('cms/order*') }}">

            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Orders</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-post">
                <li><i></i><a href="{{url('cms/order/')}}">Watch All Orders</a></li>
            </ul>

        </li>
        <li class="link {{ active('cms/review*') }}">

            <a>
                <span class="fa fa-list-alt" aria-hidden="true"></span>
                <span class="title">Reviews</span>
                {{--
                                <span class="badge badge-success d-lg-inline-block notification">20</span>
                --}}
            </a>
            <ul class="collpseableSide" id="collapse-post">
                <li><i></i><a href="{{url('cms/review/')}}">Watch All Reviews</a></li>
            </ul>

        </li>
        @if(Auth::user()->isAdministrator())

            <li class="link {{ active('cms/user*') }}">
                <a>
                    <span class="fa fa-user" aria-hidden="true"></span>
                    <span class="title">Users</span>

                </a>
                <ul class="collpseableSide" id="collapse-post">
                    <li><i></i><a href="{{url('cms/user/create')}}">Create New</a></li>
                    <li><i></i><a href="{{url('cms/user/')}}">Watch All Users</a></li>
                </ul>

            </li>
        @endif

        <li class="link {{ active('cms/tag*') }}">
            <a>
                <span class="fa fa-tag" aria-hidden="true"></span>
                <span class="title">Tags</span>
                <span class="badge badge-success d-lg-inline-block notification"
                      style="display: none !important;">10</span>
            </a>
            <ul class="collpseableSide" id="collapse-post">
                <li><i></i><a href="{{url('cms/tag/create')}}">Create New</a></li>
                <li><i></i><a href="{{url('cms/tag/')}}">Watch All Tags</a></li>
            </ul>

        </li>
        <li class="link {{ active('cms/menus*') }}">
            <a href="{{url('cms/menus')}}">
                <span class="fa fa-link" aria-hidden="true"></span>
                <span class="title">Menus</span>
            </a>
        </li>
        <li class="link {{ active('cms/link*') }}">
            <a href="{{url('cms/link')}}">
                <span class="fa fa-link" aria-hidden="true"></span>
                <span class="title">Links</span>
            </a>
        </li>
    </ul>
</nav>
@push('styles')
    <style>
        .wrapper {
            display: flex;
            align-items: stretch;
            perspective: 1500px;
        }
        a, a:hover, a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            perspective: 1500px;
        }


        #sidebar {
            min-width: 250px;
            max-width: 250px;
            transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
            transform-origin: bottom left;
        }

        #sidebar.active {
            margin-left: -250px;
            transform: rotateY(100deg);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #6d7fcc;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        #sidebar ul li.active > a, #sidebar a[aria-expanded="true"] {
            color: #fff;
        }


        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
        }

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        a.download {
            background: #fff;
            color: #7386D5;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                transform: rotateY(90deg);
                position: absolute;
                z-index: 999999;
                height: 100%;
            }
            #sidebar.active {
                margin-left: 0;
                transform: none;
            }
            #sidebarCollapse span:first-of-type,
            #sidebarCollapse span:nth-of-type(2),
            #sidebarCollapse span:last-of-type {
                transform: none;
                opacity: 1;
                margin: 5px auto;
            }
            #sidebarCollapse.active span {
                margin: 0 auto;
            }
            #sidebarCollapse.active span:first-of-type {
                transform: rotate(45deg) translate(2px, 2px);
            }
            #sidebarCollapse.active span:nth-of-type(2) {
                opacity: 0;
            }
            #sidebarCollapse.active span:last-of-type {
                transform: rotate(-45deg) translate(1px, -1px);
            }

        }

    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
@endpush