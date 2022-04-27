<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostSubCategory extends Model
{
    protected $table = 'post_sub_categories';

    use SoftDeletes;
    protected $fillable = [
        'post_main_category_id',
        'sub_category',
    ];

    public function PostMainCategory(){
        return $this->belongsTo('App\Models\Posts\PostMainCategory');
    }

    public function Post(){
      return $this->hasMany('App\Models\Posts\Post');
    }
}
