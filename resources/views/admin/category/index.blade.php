@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
       
            <div class="container py-3 col-md-8">
        <h3>Book Category
          
                <a class="float-end btn btn-primary" href="{{route('category.create')}}">Add Category</a>
            </h3>

            </div>

    </div>
</div>
<div class="row">
    <div class="container">

        <div class="col-md-22">
                <div class="container py-1 ">
                    <table id="table" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $categorytItem)

                            <tr>
                            <td>{{$categorytItem->id}}</td>
                            <td>{{$categorytItem->name}}</td>
                            <td>{!! $categorytItem->description !!}</td>
                            
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{route('category.edit',$categorytItem->id)}}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('category.destroy',$categorytItem->id) }}">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
