<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostFavoritesController extends Controller
{
    public function like(Request $request){
        $id = Auth::id();
        $post_id = $request->post_id;
        $already_liked =\App\Models\Posts\PostFavorite::where('user_id', $id)
                                                      ->where('post_id', $post_id)
                                                      ->first();
        if (!$already_liked){
            \App\Models\Posts\PostFavorite::insert([
                'user_id' => $id,
                'post_id' => $post_id,
            ]);
        } else {
            \App\Models\Posts\PostFavorite::where('user_id', $id)
                                          ->where('post_id', $post_id)
                                          ->delete();
        }

        $post_likes_count = \App\Models\Posts\Post::withCount('postFavorite')
                                                  ->findOrFail($post_id)
                                                  ->post_favorite_count;

        $param = ['post_likes_count' => $post_likes_count];
        return response()->json($param);
    }
}
