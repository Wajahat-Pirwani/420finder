@extends('layouts.app')

    @section('Categories', ' | 420 Finder')
    
    @section('content')

    <section class="py-0" style="margin-top: 100px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 border p-3 col-3" style="background: rgb(240, 242, 247);">
                    <ul class="list-unstyled">
                        @foreach($categories as $category)
                            <li class="border-bottom pb-3 mb-3">
                                <div class="form-check">
                                    <input rel="{{ $category->name }}" class="form-check-input categoriespage" type="radio" name="category_id" value="{{ $category->id }}" id="{{ $category->name }}">
                                    <label class="form-check-label" for="{{ $category->name }}" style="font-size: 18px;">
                                        <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width: 35px;border-radius: 50%;height: 35px;margin-right: 14px;">
                                        <strong class="categoryName">{{ $category->name }}</strong>
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-9 border p-3 bg-light">
                    <div id="categoryTypes"></div>
                </div>
            </div>
        </div>
    </section>

@endsection