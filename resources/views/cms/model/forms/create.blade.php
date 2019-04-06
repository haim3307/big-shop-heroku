<div class="container p-1 p-md-5" style="padding-top: 20px !important;">
    <h1 class="h2 text-center">{{ (!isset($entityItem)?'Create New ':'Edit '). ucwords($entity)}}</h1>
    <form action="{{isset($entityItem)?url("cms/$entity/$entityItem->id"):url("cms/$entity/")}}" method="post"
          enctype="multipart/form-data" class="has-advanced-upload" novalidate="novalidate">
        {{csrf_field()}}
        {{isset($entityItem)?method_field('PUT'):''}}
        @isset($entityItem)<input type="hidden" name="item_id" value="{{$entityItem->id}}">@endisset
        <input type="hidden" id="manageMode" name="manage_mode" :value="pageManageMode">
        <div class="form-group row flex-column">
            <label for="{{$entity.ucfirst($prop1??'title')}}"
                   class="col-sm-2 col-form-label">{{ucfirst($prop1??'title')}}</label>
            <input type="text" name="{{$prop1??'title'}}" class="form-control" id="{{$entity.ucfirst($prop1??'title')}}"
                   placeholder="{{ucfirst($prop1??'title')}}"
                   value="{{old($prop1??'title',isset($entityItem)?isset($prop1)?$entityItem->$prop1:$entityItem->title:'')}}">
            @if($errors->has(($prop1??'title')))
                <div class="text-danger">{{$errors->first(($prop1??'title'))}}</div> @endif
        </div>
        @if($entity != 'user')
            <div class="form-group row flex-column">
                <label for="{{$entity}}Url" class="col-sm-2 col-form-label">Url</label>
                <input type="text" name="url" class="form-control" id="{{$entity}}Url" placeholder="Url"
                       value="{{old('url',$entityItem->url??'')}}">
                @if($errors->has('url'))
                    <div class="text-danger">{{$errors->first('url')}}</div> @endif
                <small>*This is used by permalinks</small>
            </div>
        @endif
        @yield('create-content')
        {{$createContent??''}}
        <hr class="g-col-2">

        <div class="form-group row">
            <button type="submit" class="btn btn-primary">@isset($entityItem) Save Changes @else
                    Create @endisset</button>
        </div>
    </form>
</div>
@push('scripts')
    <script>
			$(document).ready(function () {
				$('#{{$entity.ucwords($prop1??'title')}}').on('blur', function (e) {
					$('#{{$entity}}Url').val($(this).val().seoFriendly());
				});
				$('#description,.html').summernote({
					height: '50vh'
				});
/*				$('[role="tagsinput"]').tagsinput({
                    typeahead: {
                        source: ['fdsf','dsfsdfsd']
                    }
                });*/
                $('select[data-role=tagsinput]').tokenize2({
                    dataSource: function(search, object){
                        $.ajax(BASE_URL+'/api/tags', {
                            data: { search: search, start: 1 },
                            dataType: 'json',
                            success: function(data){
                                var $items = [];
                                $.each(data, function(k, v){
                                    $items.push(v);
                                });
                                object.trigger('tokenize:dropdown:fill', [$items]);
                            }
                        });
                    }
                });
/*
                $('select[data-role=tagsinput]').tokenize2({
                    dataSource: BASE_URL+'/api/tags',
                    // max number of tags
                    tokensMaxItems: 0,

                    // allow you to create custom tokens
                    tokensAllowCustom: false,

                    // max items in the dropdown
                    dropdownMaxItems: 10,

                    // minimum of characters required to start searching
                    searchMinLength: 0,

                    // specify if Tokenize2 will search from the begining of a string
                    searchFromStart: true,

                    // choose if you want your search highlighted in the result dropdown
                    searchHighlight: true,

                    // custom delimiter
                    delimiter: ',',

                    // waiting time between each search
                    debounce: 0,

                    // custom placeholder text
                    placeholder: false,

                    // enable sortable
                    // requires jQuery UI
                    /!*
                                        sortable: true,
                    *!/

                    // tabIndex
                    tabIndex: 0
                });
*/
			});
    </script>
@endpush
{{--

--}}