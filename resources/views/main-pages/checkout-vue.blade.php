@extends('layouts.master')
@section('head')

@endsection
@section('content')
    <div class="container" id="shopCartApp"  style="min-height: 80vh; background-color: #fff;">
        <div class="mt-4 p-2 pt-4">
            <h1>Payment Form</h1>
            <div class="spacer"></div>

            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <payment-form :order-id="{{request()->order_id}}" :info="{{auth()->user()->info??'{}'}}" :email="'{{auth()->user()->email}}'"></payment-form>
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
