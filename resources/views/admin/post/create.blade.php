@extends('layouts.app')
@section('content')

<div class="row">
    <div class="pl-5">
        <div class="col-md-10 ">
            <div class="container">
                <div class="container py-2 col-md-8">
            <h3 class="group-control">Post</h3>
                <a class="float-end btn btn-danger group-control " href="{{route('post')}}">Back</a>
                </div>
            </div>
            <div class="container form-group">
            <form action="{{route('post.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
              
                <div class="container col-md-8">
                    <div class="col-md-12">
                  
                    <div class="mb-3 form-group">
                        <label for="name">POst</label>
                        <input type="text" name="name" class="form-control">
                        @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>
                    
                    <div class="mb-3 form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class=" ckeditor form-control"></textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small>@enderror

                    </div>
                    <div class="mb-3 form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image') <small class="text-danger">{{ $message }}</small>@enderror

                    </div>
                    <div class="col-md-6 mb-3 ">
                        <select name="category_id" class="col-md-6 " class="form-control">
                            @foreach ($category as $categoryItem )
                            <option value="{{ $categoryItem->id }}" class="form-control">{{ $categoryItem->name }}</option>
                                
                            @endforeach
                        </select>
                    </div>
                        <br>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">Save Post</button>
                    </div>
                          
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
