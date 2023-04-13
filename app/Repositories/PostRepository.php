<?php
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository implements PostRepositoryInterface {
    public function all(){
        return Post::all();
    }

    public function store($data){
      $data['user_id']=Auth::id();
       $post= Post::create($data);
       if(array_key_exists('image',$data)){
           $post->addMedia($data['image'])->toMediaCollection('post_image');
       }
       return $post;
    }

    public function edit($id){
      return  $post=Post::find($id);
    }

}