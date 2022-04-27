<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentFavoritesController extends Controller
{
    public function commentLike(Request $request){
        $id = Auth::id();
        $post_comment_id = $request->post_comment_id;
        $already_liked =\App\Models\Posts\PostCommentFavorite::where('user_id', $id)
                                                      ->where('post_comment_id', $post_comment_id)
                                                      ->first();
        if (!$already_liked){
            \App\Models\Posts\PostCommentFavorite::insert([
                'user_id' => $id,
                'post_comment_id' => $post_comment_id,
            ]);
        } else {
            \App\Models\Posts\PostCommentFavorite::where('user_id', $id)
                                          ->where('post_comment_id', $post_comment_id)
                                          ->delete();
        }

        $comment_likes_count = \App\Models\Posts\PostComment::withCount('postCommentFavorite')
                                                  ->findOrFail($post_comment_id)
                                                  ->post_comment_favorite_count;

        $param = ['comment_likes_count' => $comment_likes_count];
        return response()->json($param);
    }
}
