@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
            <div class="container py-3 col-md-12">
        <h3>post </h3>
            <a class="float-end btn btn-danger" href="{{route('post')}}">Back</a>
            </div>
        <div class="container">
        <form action="{{route('post.update',$post->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('put')
                <div class="mb-3">
                    <label for="name">post</label>
                <input type="text" name="name" value="{{$post->name}}" class="form-control">
                @error('name') <small class="text-danger">{{ $message }}</small>@enderror

                </div>
                
                <div class="mb-3 form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="summernote" rows="3" class="ckeditor form-control">{{$post->description}}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small>@enderror

                </div>
                <div class="mb-3 form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($post->hasMedia('post_image'))
                    <img src="{{$post->getMedia('post_image')[0]->getFullUrl()}}" style="width:80px;height:50px">
                    @endif
                </div>
                <div class="mb-3 form-group">
                        <label for="">Select Your Category</label>
                        <select name="category_id"  class="form-control">
                            
                            @foreach ($category as $categoryItem )
                            <option value="{{ $categoryItem->id }}"{{ $post->category_id==$categoryItem->id ?'selected':'' }}>{{ $categoryItem->name }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                   
                <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Update post</button>
                </div>
        </form>
        </div>
    </div>
</div>

@endsection
