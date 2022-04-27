<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts\Post;

class PostsController extends Controller
{
    //ホーム
    public function index(){
        return view('posts.index');
    }

    //自分の投稿
    public function myPost(){
        return view('posts.mypost');
    }

    //自分のいいねした投稿
    public function myFavoritePost(){
        return view('posts.my_favorite_post');
    }

    //カテゴリー別表示
    public function categoryPost($categoryID){

      $categoryPosts = \App\Models\Posts\Post::where('post_sub_category_id', $categoryID)
                        ->with(['user', 'postSubCategory','postFavorite','actionLog'])
                        ->withCount('postComment','postFavorite','actionLog')
                        ->latest()
                        ->get();

        return view('posts.category_post')->with([
       "categoryPosts" => $categoryPosts,
        ]);
    }

    //投稿フォーム表示
    public function postForm(){
        $subCategories = DB::table('post_sub_Categories')
                            ->get();
        return view('posts.post')->with([
       "subCategories" => $subCategories,
        ]);
    }

    //新規投稿
    public function postCreate(PostRequest $request){
        $sub = $request->sub;
        $title = $request->title;
        $post = $request->post;
        $date = date("Y-m-d");
        $id = Auth::id();
        \App\Models\Posts\Post::insert([
            'user_id' => $id,
            'post_sub_category_id' => $sub,
            'title' => $title,
            'post' => $post,
            'event_at' => $date,
        ]);
        return redirect('/home');
    }

    //投稿詳細画面
    public function post($postID){

        $id = Auth::id();
        $date = date("Y-m-d");
        $viewUser = \App\Models\ActionLogs\ActionLog::where('post_id', $postID)
                                                    ->where('user_id', $id)
                                                    ->first();

        if (!$viewUser) {
            \App\Models\ActionLogs\ActionLog::insert([
                'user_id' => $id,
                'post_id' => $postID,
                'event_at' => $date,
            ]);

        } else {

        }

        $postsDetails = \App\Models\Posts\Post::where('id', $postID)
                        ->with(['user', 'postSubCategory','postComment','postFavorite','actionLog'])
                        ->withCount('postComment','postFavorite','actionLog')
                        ->first();

        $postComments = \App\Models\Posts\PostComment::where('post_id', $postID)
                        ->with(['user'])
                        ->withCount('postCommentFavorite')
                        ->get();

        return view('posts.post_detail')->with([
            'postsDetails' => $postsDetails,
            'postComments' => $postComments,
        ]);
    }

    //投稿編集フォーム
    public function postEditForm($postID){

        $postsEditInfo = \App\Models\Posts\Post::where('id', $postID)
                        ->with(['postSubCategory'])
                        ->first();

        $subID = \App\Models\Posts\Post::where('id', $postID)
                ->select('post_sub_category_id')
                ->first();

        $subCategories = \App\Models\Posts\PostSubCategory::
                        where('id', '!=', $subID->post_sub_category_id)
                        ->get();

        return view('posts.post_edit_form')->with([
            'postsEditInfo' => $postsEditInfo,
            'subCategories' => $subCategories,
            'subID' => $subID,
        ]);
    }

    //投稿編集機能
    public function postUpdate(PostRequest $request, $postID){
        $sub = $request->sub;
        $title = $request->title;
        $post = $request->post;
        $id = Auth::id();

        \DB::table('posts')
            ->where('id', $postID)
            ->update([
                'post_sub_category_id' => $sub,
                'update_user_id' => $id,
                'title' => $title,
                'post' => $post,
            ]);

        $postsDetails = \App\Models\Posts\Post::where('id', $postID)
                        ->with(['user', 'postSubCategory','postComment','postFavorite','actionLog'])
                        ->withCount('postComment','postFavorite','actionLog')
                        ->first();

        $postComments = \App\Models\Posts\PostComment::where('post_id', $postID)
                        ->with(['user'])
                        ->withCount('postCommentFavorite')
                        ->get();

        return redirect()->route('detail',[$postID])->with([
            'postsDetails' => $postsDetails,
            'postComments' => $postComments,
        ]);
    }

    //投稿削除機能
    public function delete($postID){
        $id = Auth::id();

        \App\Models\Posts\Post::
            where('id', $postID)
            ->update(['delete_user_id' => $id]);

        \App\Models\Posts\Post::
            where('id', $postID)
            ->delete();

        return redirect('/home');
    }

    //投稿検索機能
    public function search(Request $request){
        $keyword = $request->input('search');

        if (!empty($keyword)){
            $searches = \App\Models\Posts\Post::
                        with(['user', 'postSubCategory','postComment','postFavorite','actionLog'])
                        ->withCount('postComment','postFavorite','actionLog')
                        ->where('title','like', '%' .$keyword. '%')
                        ->orWhere('post','like', '%' .$keyword. '%')
                        ->orWhereHas('postSubCategory', function ($query) use ($keyword){
                            $query->where('sub_category', '=', $keyword);
                        })
                        ->latest()
                        ->get();


            return view('posts.search')->with([
            'searches' => $searches,
            'keyword' => $keyword,
          ]);
        }

        return redirect('/home');
    }
}
