<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('*', function($view){

      $id = Auth::id();

      //メインカテゴリー＞サブカテゴリー
      $categories = \App\Models\Posts\PostMainCategory::with('postSubCategory')->get();
      //メインカテゴリー＞post_main_category_id
      $mainCategoriesID = \App\Models\Posts\PostSubCategory::
                            select('post_main_category_id')
                            ->get()
                            ->toArray();

      $posts = \App\Models\Posts\Post::
                with(['user', 'postSubCategory','postFavorite','actionLog'])
                ->withCount('postComment','postFavorite','actionLog')
                ->latest()
                ->get();

      $myPosts = \App\Models\Posts\Post::where('user_id', $id)
                ->with(['user', 'postSubCategory','postFavorite','actionLog'])
                ->withCount('postComment','postFavorite','actionLog')
                ->latest()
                ->get();

      $myFavorites = \App\Models\Posts\Post::whereIn('id', function($query){
                                            $id = Auth::id();
                                            $query->select('post_id')
                                                  ->from('post_favorites')
                                                  ->where('user_id', $id);
                                            })
                                        ->with(['user', 'postSubCategory','postFavorite','actionLog'])
                                        ->withCount('postComment','postFavorite','actionLog')
                                        ->latest()
                                        ->get();

        $view->with([
          "categories" => $categories,
          "mainCategoriesID" => $mainCategoriesID,
          "posts" => $posts,
          "myPosts" => $myPosts,
          "myFavorites" => $myFavorites,
        ]);
      });
  }
}
