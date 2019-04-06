@extends('cms.cms')
@section('head')
    <link rel="stylesheet" href="{{asset('css/cms/fileUpload.css')}}">
@endsection
@section('content')
    <div style="margin-top: 20px;"></div>
    @include('cms.model.forms.create')

@endsection
@push('scripts')
    <script src="{{asset('js/cms/fileUpload.js')}}"></script>

@endpush