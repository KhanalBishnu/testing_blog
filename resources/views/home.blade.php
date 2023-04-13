@extends('layouts.app')
@section('content')
<style>

</style>
<div class="container-fluid">
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10"></div>
                <div class="col-lg-2 mb-3"><a class="btn btn-primary user_profile" href="{{ route('userProfile') }}" >My Profile</a></div>
            </div>
        </div>
        @if(count($users)>0)
       
                <div class="col-lg-3">
                    <ul class="list-group">
                        @foreach ($users as $user)
                        <li id="{{ $user->id }}-select_status" class="list-group-item list-group-item-dark cursor-pointer user_list " data-id="{{ $user->id }}">

                        @if ($user->hasMedia('user_image'))
                            <img src="{{ $user->getMedia('user_image')[0]->getFullUrl() }}" alt="" class="img-thumbnail" style="height:50px;width:80px">
                        @else
                        <img src="{{ asset('image/images.jpg')  }}" alt="" srcset="" class="img-thumbnail" style="height:50px;width:80px">
                        @endif
                                {{ $user->name }}
                                <b><sup id="{{ $user->id }}-status" class="offline-status">Offline</sup></b>

                            </li>
                        
                        @endforeach
                    </ul>
                </div>
               
                <div class="col-lg-9">
                    <h1 class="start-head">Click For Start Chat</h1>
                    <div class="chat-section " >
                         <div id="chat-container">


                            {{-- chat here for sender and receiver  --}}
                            
                            </div>
                            <form action="" id="chat-form">
                                <input type="text" name="message" id="message" required placeholder="Enter message" >
                                <input type="submit" value="Send" class="btn btn-primary btn-lg float-end mx-5 ">
                            </form>
                       
                    </div>
                </div>
        @else
            <div class="container-fluid text-center col-lg-12">
                <h4>User Not Found!</h4>
            </div>
        @endif
    </div>
</div>

@endsection
