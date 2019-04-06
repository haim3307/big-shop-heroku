@extends('cms.model.create')

@section('create-content')
    @include('cms.model.inc.file-upload',['name'=>'main_img'])
    <hr class="g-col-2">
    @include('cms.inc.forms.inputs.tags')
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" id="description">{{old('description',$entityItem->description??'')}}</textarea>
        @if($errors->has('description')) <div class="text-danger">{{$errors->first('description')}}</div> @endif

    </div>
    <div class="form-group">
        <label for="article">Article</label>
        <textarea name="article" class="form-control" id="article">{{old('article',$entityItem->description??'')}}</textarea>
        @if($errors->has('article')) <div class="text-danger">{{$errors->first('article')}}</div> @endif

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#article').summernote({
                height: '50vh'
            });
        });
    </script>
@endpush