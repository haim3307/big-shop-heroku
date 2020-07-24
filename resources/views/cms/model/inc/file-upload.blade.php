<div class="container box" role="main">

    <div class="box__input">
        <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43">
            <path
                d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/>
        </svg>
        <input type="file" name="{{$name}}" id="file" class="box__file" data-multiple-caption="{count} files selected"
               multiple/>
        <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
        <button type="submit" class="box__button">Upload</button>
    </div>


    <div class="box__uploading">Uploading&hellip;</div>
    <div class="box__success">Done! <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?"
                                       class="box__restart" role="button">Upload more?</a></div>
    <div class="box__error">Error! <span></span>. <a href="https://css-tricks.com/examples/DragAndDropFileUploading//?"
                                                     class="box__restart" role="button">Try again!</a></div>
    @if($errors->has($name))
        <div class="text-danger">{{$errors->first($name)}}</div> @endif

</div>
@push('styles')
    <style>
        .box__input {
            display: grid;
        }

        .box__input label {
            justify-self: center;
        }
    </style>
@endpush
