<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable=[
        'name',
        'description',
        'user_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function like(){
        return $this->hasMany(Like::class);
    }
    // one time like
    public function likeBy(User $user){
        return $this->like->contains('user_id',$user->id);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
