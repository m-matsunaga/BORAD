<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class PostCommentsController extends Controller
{

    public function commentEditForm($commentID){

        $commentsEditInfo = \App\Models\Posts\PostComment::where('id', $commentID)
                        ->first();

        return view('posts.comment_edit_form')->with([
            'commentsEditInfo' => $commentsEditInfo,
        ]);
    }

    public function commentCreate(CommentRequest $request, $postID){
        $comment = $request->comment;
        $date = date("Y-m-d");
        $id = Auth::id();

        \App\Models\Posts\PostComment::insert([
                'user_id' => $id,
                'post_id' => $postID,
                'comment' => $comment,
                'event_at' => $date,
            ]);

        return back();
    }

    public function commentUpdate(CommentRequest $request, $commentID){
        $comment = $request->comment;
        $id = Auth::id();

        \App\Models\Posts\PostComment::
            where('id', $commentID)
            ->update([
                'update_user_id' => $id,
                'comment' => $comment,
            ]);

        $postID = \App\Models\Posts\PostComment::
                     where('id', $commentID)
                     ->first();

        $postsDetails = \App\Models\Posts\Post::where('id', $postID->post_id)
                        ->with(['user', 'postSubCategory','postComment','postFavorite','actionLog'])
                        ->withCount('postComment')
                        ->first();

        $postComments = \App\Models\Posts\PostComment::where('post_id', $postID->post_id)
                        ->with(['user'])
                        ->withCount('postCommentFavorite')
                        ->get();

        return redirect()->route('detail',['postID' => $postID->post_id])->with([
            'postsDetails' => $postsDetails,
            'postComments' => $postComments,
        ]);
    }

    public function delete($commentID){
        $id = Auth::id();

        \App\Models\Posts\PostComment::
            where('id', $commentID)
            ->update(['delete_user_id' => $id]);

        \App\Models\Posts\PostComment::
            where('id', $commentID)
            ->delete();

        return redirect('/home');
    }
}
