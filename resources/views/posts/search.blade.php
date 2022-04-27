
@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">掲示板投稿一覧</p>
@endsection

@section('content')

<div id="container">
  <div id="main">
    <div class="post-container">

  @foreach ($searches as $search)
  <div class="post">
    <div class="post-1">
      <p>{{ $search->user->username }}さん</p>
      <p>{{ $search->event_at->format('Y年n月d日')}}</p>
    </div>
    <div class="post-2">
      <a href="/post/{{$search->id}}" class="post-title"><p>{{ $search->title }}</p></a>
    </div>
    <div class="post-3">
      <p class="post-sub-category">{{ $search->PostSubCategory->sub_category }}</p>
      <div class="post-count">
        <p class="post-count-content">View 0</p>
        <p class="post-count-content">コメント数：{{$search->post_comment_count}}</p>
        @if(!$search->isLikedBy(Auth::user()))
        <img src="{{ asset('images/heart_border.png') }}" alt="ハート" class="heart post-count-content like-toggle" data-post-id="{{ $search->id }}"><p class="post-heart">{{$search->post_favorite_count}}</p>
        @else
        <img src="{{ asset('images/heart.png') }}" alt="ハート" class="heart post-count-content like-toggle" data-post-id="{{ $search->id }}"><p class="post-heart">{{$search->post_favorite_count}}</p>
        @endif
      </div>
    </div>
  </div>
  @endforeach
    </div>
  </div>
  <div id="side">
    <div class="side-contents">
    @if(Auth::user()->admin_role === 1)
      <div class="side-button">
        <a href="/category/form" class="a-category">カテゴリー追加</a>
      </div>
    @endif
      <div class="side-button">
        <a href="/post/form" class="a-posts">新規投稿</a>
      </div>
      <div class="side-button">
        <a href="/home/my/favorite/post" class="a-posts">いいねした投稿</a>
      </div>
      <div class="side-button">
        <a href="/home/my/post" class="a-posts">自分の投稿</a>
      </div>
    {!! Form::open(['url' => '/search']) !!}
      <div class="side-button search">
        {!! Form::search('search', $keyword, ['class' => 'search-form', 'placeholder' => 'キーワード']) !!}
        <button type="search" class="search-button"><p>検索</p></button>
      </div>
    {!! Form::close() !!}
    </div>
    <div class="side-category">
    <p class="category-title">Category</p>
  @foreach ($categories as $category)
<ul class="category-ul">
  <li class="main-category-li">{{ $category->main_category }}<span class="main-category-li-span">▼</span></li>
    <ul class="sub-category-ul">
      @foreach ($category->PostSubCategory as $post_sub_category)
      <li class="sub-category-li"><a href="/home/post/category/{{$post_sub_category->id}}" class="sub-category-li-a">{{ $post_sub_category->sub_category }}</a></li>
      @endforeach
    </ul>
</ul>
  @endforeach
    </div>
  </div>
</div>
@endsection
