@extends('layouts.master')
@section('content')
    <div style="background-image: url({{asset('_img/beach-832346_1920.jpg')}});">
        @include('auth.errors')
        @yield('content')
    </div>
@endsection
@section('script')
    <script>
			window.fbAsyncInit = function () {
				FB.init({
					appId: '{{env('FACEBOOK_CLIENT_ID')}}',
					cookie: true,
					xfbml: true,
					version: 'v3.2'
				});

				FB.AppEvents.logPageView();

			};

			(function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.id = id;
				js.src = "https://connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
    </script>
@endsection