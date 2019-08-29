@extends('admin.layouts.base')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categorías EGSI</div>
                <div class="card-body">
                    @foreach($parentCategories as $category)
                        <ul>
                            <li>{{$category->name}}</li>
                            @if(count($category->subcategories))
                                @include('categories.subCategoryList', ['subcategories' => $category->subcategories])
                            @endif
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
