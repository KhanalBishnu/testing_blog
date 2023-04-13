@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
            <div class="container py-3 col-md-12">
        <h3>Book Category</h3>
            <a class="float-end btn btn-danger" href="{{route('category')}}">Back</a>
            </div>
        <div class="container">
        <form action="{{route('category.update',$category->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('put')
                <div class="mb-3">
                    <label for="name">Category</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                </div>
               
                <div class="mb-3 form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="summernote" rows="3" class="ckeditor form-control">{{ $category->description }}</textarea>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Update Category</button>
                </div>
        </form>
        </div>
    </div>
</div>

@endsection
