<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public function Post(){
      return $this->belongsTo('App\Models\Posts\Post');
    }

    public function User(){
        return $this->belongsTo('App\Models\Users\User');
    }


}
