<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//// Login前
Route::group(['middleware' => ['guest']], function () {

    // Login
    Route::get('/','Auth\Login\LoginController@showLogin')->name('showLogin');
    Route::get('login','Auth\Login\LoginController@login')->name('login');
    Route::post('login','Auth\Login\LoginController@login')->name('login');

    // // Register
    Route::get('/register', 'Auth\Register\RegisterController@register');
    Route::post('/register', 'Auth\Register\RegisterController@register');
    Route::get('/register/form', 'Auth\Register\RegisterController@createForm');
    Route::get('/register/confirm', 'Auth\Register\RegisterController@RegisterConfirm');
    Route::post('/register/execute', 'Auth\Register\RegisterController@registerExecute');

    // // Add
    Route::get('/added', 'Auth\Register\RegisterController@createDone');
    // Route::post('/added', 'Auth\RegisterController@createDone');

});

//// Login中
Route::group(['middleware' => ['auth']], function () {

    //Home
    Route::get('/home','User\Post\PostsController@index')->name('home');
    Route::post('/home','User\Post\PostsController@index')->name('home');
    Route::get('/home/my/post','User\Post\PostsController@myPost');
    Route::get('/home/my/favorite/post','User\Post\PostsController@myFavoritePost');
    Route::get('/home/post/category/{categoryID}','User\Post\PostsController@categoryPost');

    //logout
    Route::get('/logout','Auth\Login\LoginController@logout')->name('logout');

    //New Post
    Route::get('/post/form','User\Post\PostsController@postForm');
    Route::post('/post','User\Post\PostsController@postCreate');

    //category
    Route::get('/category/form','Admin\Post\PostMainCategoriesController@categoryForm');
    Route::post('/category/main','Admin\Post\PostMainCategoriesController@categoryMain');
    Route::post('/category/sub','Admin\Post\PostSubCategoriesController@categorySub');
    Route::get('/main/{id}/delete','Admin\Post\PostMainCategoriesController@categoryMainDelete');
    Route::get('/sub/{id}/delete','Admin\Post\PostSubCategoriesController@categorySubDelete');

    //post detail
    Route::get('/post/{postID}','User\Post\PostsController@post')->name('detail');
    Route::post('/post/{postID}','User\Post\PostsController@post')->name('detail');

    //post comment
    Route::post('/post/comment/{postID}','User\Post\PostCommentsController@commentCreate');

    //post edit
    Route::get('/post/edit/{postID}','User\Post\PostsController@postEditForm');
    Route::post('/post/update/{postID}','User\Post\PostsController@postUpdate');

    //post delete
    Route::get('post/delete/{postID}', 'User\Post\PostsController@delete');

    //comment edit
    Route::get('/comment/edit/{commentID}','User\Post\PostCommentsController@commentEditForm');
    Route::post('/comment/update/{commentID}','User\Post\PostCommentsController@commentUpdate');

    //comment delete
    Route::get('comment/delete/{commentID}', 'User\Post\PostCommentsController@delete');

    //post search
    Route::get('/search','User\Post\PostsController@search')->name('search');
    Route::post('/search','User\Post\PostsController@search')->name('search');

    //post like
    Route::post('/like', 'User\Post\PostFavoritesController@like');

    //comment like
    Route::post('/comment/like', 'User\Post\PostCommentFavoritesController@commentLike');
});
