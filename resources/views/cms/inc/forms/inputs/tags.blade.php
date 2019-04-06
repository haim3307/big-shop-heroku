<div class="form-group row flex-column">
    <label for="{{$entity}}Tags" class="col-sm-2 col-form-label">Tags</label>
    <select multiple="multiple" name="tags[]" data-role="tagsinput" class="form-control" id="{{$entity}}Tags" placeholder="Add Tags">
        @isset($entityItem)
            @foreach($entityItem->tags as $tag)
                <option value="{{$tag->url}}" selected="selected">{{$tag->name}}</option>
            @endforeach
        @endisset
    </select>
</div>