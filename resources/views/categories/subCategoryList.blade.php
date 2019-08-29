@foreach($subcategories as $subcategory)
    <ul>
        <li>{{$subcategory->name}}</li>
        @if(count($subcategory->subcategories))
            @include('categories.subCategoryList',['subcategories' => $subcategory->subcategories])
        @endif
    </ul>
@endforeach
