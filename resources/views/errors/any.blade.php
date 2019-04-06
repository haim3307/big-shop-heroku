@extends('layouts.master')
@section('content')
    <div class="container-1112" style="min-height: 60vh">

        <div class="jumbotron bg-light">
            <h1 class="display-4">Hello, User!</h1>
            <p class="lead">{{$msg}}</p>
            <hr class="my-4">
            <p></p>
            <a class="btn btn-primary btn-lg submit" href="{{url('')}}" role="button">Continue Shopping</a>
        </div>
    </div>

@endsection
@section('script')
    <style>
        .spacer {
            margin-bottom: 24px;
        }

        /**
         * The CSS shown here will not be introduced in the Quickstart guide, but shows
         * how you can use CSS to style your Element's container.
         */
        .StripeElement {
            background-color: white;
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid #ccd0d2;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: #fa755a;
        }
    </style>
    <script>
        function tplVue() {
        }

        function tplJQ() {

        }
    </script>
@endsection
