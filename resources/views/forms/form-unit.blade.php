<div class="form-group">
    <label for="{{$name}}">{{$display??ucwords($name)}}</label>
    <input type="{{$type??'text'}}" class="form-control" id="{{$name}}" name="{{$name}}" value="{{$value}}">
    @if($errors->has($name)) <div class="text-danger">{{$errors->first($name)}}</div> @endif
</div>