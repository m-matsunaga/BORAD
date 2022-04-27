<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $table = 'posts';

    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    protected $dates = ['event_at'];

    public function User(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function PostSubCategory(){
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }

    public function PostComment(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function PostFavorite(){
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function ActionLog(){
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    public function isLikedBy($user): bool {
        return \App\Models\Posts\PostFavorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
}
