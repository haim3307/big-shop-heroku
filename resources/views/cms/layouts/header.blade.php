<header class="f-row align-items-center justify-content-between" id="nav-header"
        style="padding: 10px; margin: 0;">
    <div class=" col-md-7">
        <ul>
            <li id="welcome" class="d-lg-block">
                @if($user = Auth::user())
                    Welcome back
                    {{ucwords($user->role->name)}}
                    <strong>{{ucwords($user->name)}}</strong>
                @endif

            </li>

        </ul>
    </div>
    <div class="col-md-2 d-flex" style="text-align: right;flex-flow: column;">

        <nav class="navbar bg-faded d-md-none">
            <button style="z-index: 99999999999; position: relative;" type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
            @push('styles')
                <style>
                    #sidebarCollapse {
                        width: 40px;
                        height: 40px;
                        background: #f5f5f5;
                    }

                    #sidebarCollapse span {
                        width: 80%;
                        height: 2px;
                        margin: 0 auto;
                        display: block;
                        background: #555;
                        transition: all 0.8s cubic-bezier(0.810, -0.330, 0.345, 1.375);
                        transition-delay: 0.2s;
                    }

                    #sidebarCollapse span:first-of-type {
                        transform: rotate(45deg) translate(2px, 2px);
                    }
                    #sidebarCollapse span:nth-of-type(2) {
                        opacity: 0;
                    }
                    #sidebarCollapse span:last-of-type {
                        transform: rotate(-45deg) translate(1px, -1px);
                    }


                    #sidebarCollapse.active span {
                        transform: none;
                        opacity: 1;
                        margin: 5px auto;
                    }
                    @media (max-width: 768px) {
                        #sidebar {
                            margin-left: -250px;
                            transform: rotateY(90deg);
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
{{--            <button style="height: 40px;" class="navbar-toggler" type="button"
                    data-toggle="collapse" data-target="#side-menu" aria-controls="side-menu"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="

fa fa-bars fa-lg"></i>
            </button>--}}

        </nav>
        <div class="d-grid align-items-center" style="padding: 0 20px;">
            <form action="{{url('logout')}}" method="POST">
                {{csrf_field()}}
                <label for="submit" class="d-block" style="min-width: 70px; margin-bottom: 0;" href="">
                <span class="link">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
                <input type="submit" id="submit" class="d-none">
                </span>
                </label>
            </form>
        </div>

    </div>
</header>