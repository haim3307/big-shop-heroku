@extends('cms.cms')

@section('content')
    <div class="f-row mt-4">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <div class="container">@include('cms.inc.list-reviews')</div>
            <div style="padding: 15px;">{!! $reviews->render("pagination::bootstrap-4") !!}</div>
        </div>
    </div>

@endsection