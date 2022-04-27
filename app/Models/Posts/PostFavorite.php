<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post__id',
    ];

    public function Post(){
      return $this->belongsTo('App\Models\Posts\Post');
    }

    public function User(){
        return $this->belongsTo('App\Models\Users\User');
    }
}
