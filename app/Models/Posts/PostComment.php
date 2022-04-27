<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostComment extends Model
{
    protected $table = 'post_comments';

    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    protected $dates = ['event_at'];

    public function Post(){
      return $this->belongsTo('App\Models\Posts\Post');
    }

    public function User(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function PostCommentFavorite(){
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }

    public function commentLikedBy($user): bool {
        return \App\Models\Posts\PostCommentFavorite::where('user_id', $user->id)->where('post_comment_id', $this->id)->first() !==null;
    }
}
