<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    public function Post(){
      return $this->hasMany('App\Models\Posts\Post');
    }

    public function PostComment(){
      return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function PostFavorite(){
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function PostCommentFavorite(){
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }
}
