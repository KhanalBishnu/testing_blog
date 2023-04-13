@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
    <div class="alert alert-success">{{session('message')}}</div>
    @endif
            <div class="container py-3 col-md-8">
        <h3>post 
           
                <a class="float-end btn btn-primary" href="{{route('post.create')}}">Add post</a>
        </h3>

            </div>

    </div>
</div>

    <div class="container">
        <div class="row">

       
                    <table  class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th> Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $posttItem)

                            <tr>
                            <td>{{$posttItem->id}}</td>
                            <td>{{$posttItem->name}}</td>
                            <td >{{ $posttItem->description }}</td>
                            @if($posttItem->hasMedia('post_image'))
                            <td>
                                <img src="{{$posttItem->getMedia('post_image')[0]->getFullUrl()}}" style="width:80px;height:50px">
                            </td>
                            @else
                           <td>Not image Found of {{$posttItem->name}}</td>

                            @endif
                            <td>{{$posttItem->category->name}} </td>
                            <td>
                                <a class="btn btn-primary " href="{{route('post.edit',$posttItem->id)}}">Edit</a>
                                <a class="btn btn-danger " href="{{ route('post.destroy',$posttItem->id) }}">Delete</a>
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
</div>

@endsection
