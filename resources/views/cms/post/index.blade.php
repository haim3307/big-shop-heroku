@extends('cms.model.index')

@section('index-content')
    @component('cms.model.inc.data-table',['items'=>$items,'entity'=>$entity])

    @endcomponent

@endsection
