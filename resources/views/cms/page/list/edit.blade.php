@extends('cms.cms')
@section('head')
    <link rel="stylesheet" href="{{asset('css/cms/fileUpload.css')}}">
@endsection
@section('content')

    @include('auth.errors')
    <form class="dynamicOptionsForm p-4"
          action="{{url(isset($listItem->id)?"cms/page/$page->id/list/$pageList->id":"cms/page/$page->url/$pageList->url")}}"
          id="CMSApp"
          method="POST" enctype="multipart/form-data">
        <h2 class="text-center">{{isset($listItem->id)?'Edit':'Create'}} List Item</h2>

        {{csrf_field()}}
        {{isset($listItem)?method_field('PATCH'):''}}
        <friendly-title :title="'title'"></friendly-title>
        <textarea data-type="html-input" class="form-control" type="text" name="title">{{old('title',$listItem->title??'')}}</textarea>
        @isset($listItem)   <input type="hidden" name="item_id" value="{{$listItem->id}}">@endisset
        @foreach($pageList->options_layout as $extraAttrTitle=>$extraAttr)
            <friendly-title :title="'{{$extraAttrTitle}}'"></friendly-title>
            @php($value = $listItem->options->$extraAttrTitle->value??$extraAttr->value)
            <div class="form-group">
                @if($extraAttr->type == 'd')

                    <datetime type="datetime" input-format="YYYY-MM-DD h:mm a" value="{{$value}}"
                              name="{{$extraAttrTitle}}" wrapper-class="d-inline"
                              input-class="form-control"></datetime>
                @elseif($extraAttr->type == 't')
                    <textarea data-type="long-html-input" style="color:black;" class="form-control"
                              name="{{$extraAttrTitle}}">{!! $value !!}</textarea>
                @elseif($extraAttr->type == 's')
                    <textarea data-type="html-input" style="color:black;" class="form-control"
                              name="{{$extraAttrTitle}}">{!! $value !!}</textarea>
                @elseif($extraAttr->type == 'img')
                    @include('cms.model.inc.file-upload',['name'=>$extraAttrTitle])
                    <input class="form-control" type="hidden" value="{{$value}}" name="old_{{$extraAttrTitle}}">
                @else
                    <input class="form-control"
                           value="{{$value}}"
                           type="text" name="{{$extraAttrTitle}}">

                @endif
            </div>

        @endforeach
        <input type="submit" class="btn btn-primary" value="Send">

    </form>
    {{--            <datetime v-if="extraAttr.type == 'd'" type="datetime" input-format="YYYY-MM-DD h:mm a"
                          v-model="product.options[extraAttrTitle].value" wrapper-class="d-inline"
                          input-class="form-control"></datetime>--}}
    {{--
                <input class="form-control" :value="extraAttr.value">
    --}}

@endsection
@push('scripts')
    @verbatim
        <script>
            Vue.component('friendly-title', {
                props: ['title'],
                template: '<label class="label" style="margin:20px 0;">{{title | seoUnFriendly | capitalize}} : </label>'
            });
        </script>
    @endverbatim
    <script>
        $(document).ready(function () {
            Vue.nextTick(function () {
                $('textarea[data-type="html-input"]').summernote();
                $('textarea[data-type="long-html-input"]').summernote({
                    minHeight: '15vw'
                });
            });
        });
        CMSAppOBJ.data.list = {!! $pageList !!};
        CMSAppOBJ.data.item = {!! $listItem??'{}' !!};
        const CMSApp = new Vue(CMSAppOBJ);
    </script>
    <style>
        .dynamicOptionsForm {

        }
    </style>
@endpush
@push('scripts')
    <script src="{{asset('js/cms/fileUpload.js')}}"></script>

@endpush