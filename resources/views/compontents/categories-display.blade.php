<div class="categoriesDisplay">
    <nav>
        <ul class="d-grid grid-col-md-2">
            @foreach($categories as $category)
                @include('compontents.category',['category'=>$category])
            @endforeach
        </ul>
    </nav>
</div>
