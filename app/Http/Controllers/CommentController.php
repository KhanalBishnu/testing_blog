<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentStore(Request $request,$id){
        $post=Post::find($id);
        if($post){
           $comment= Comment::create([
                'user_id'=>Auth::id(),
                'post_id'=>$id,
                'comment'=>$request->comment,
                'pare'
            ]);
            $parent_id=Comment::where('user_id',Auth::id())->first();
            if($parent_id){
                $comment->user_parent_id=$parent_id->user_id;
                $comment->save();
            }
 // Retrieve the comment with the associated user
 $commentWithUser = Comment::with('users')->find($comment->id);

 return response()->json([
     'success' => true,
     'message' => 'Comment posted successfully!',
     'comment' => $commentWithUser
 ]);        }
    }
}
