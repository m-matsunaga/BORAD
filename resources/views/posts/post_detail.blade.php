@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">投稿詳細画面</p>
@endsection

@section('content')

<div id="post-detail-container">
  <div id="post-detail-left">
    <div class="detail-post-position">
      <div class="detail-post">
        <div class="post-1">
          <p>{{ $postsDetails->user->username }}さん</p>
          <p>{{ $postsDetails->event_at->format('Y年n月d日')}}</p>
        </div>
        <div class="post-2">
          <p>{{ $postsDetails->title }}</p>
          <a href="/post/edit/{{$postsDetails->id}}" class="post-edit-button">編集</a>
        </div>
        <div class="post-4">
          <p>{{ $postsDetails->post }}</p>
        </div>
        <div class="post-3">
          <p class="post-sub-category">{{ $postsDetails->PostSubCategory->sub_category }}</p>
          <div class="post-count">
            <p class="post-count-content">View {{$postsDetails->action_log_count}}</p>
            <p class="post-count-content">コメント数：{{$postsDetails->post_comment_count}}</p>
        @if(!$postsDetails->isLikedBy(Auth::user()))
        <img src="{{ asset('images/heart_border.png') }}" alt="ハート" class="heart post-count-content like-toggle" data-post-id="{{ $postsDetails->id }}"><p class="post-heart">{{$postsDetails->post_favorite_count}}</p>
        @else
        <img src="{{ asset('images/heart.png') }}" alt="ハート" class="heart post-count-content like-toggle" data-post-id="{{ $postsDetails->id }}"><p class="post-heart">{{$postsDetails->post_favorite_count}}</p>
        @endif
          </div>
        </div>
      </div>
    <h2 class="comment">コメント：</h2>
@foreach ($postComments as $postComment)
      <div class="detail-post-comment">
        <div class="post-1">
          <div class="comment-name-at">
            <p class="comment-name">{{ $postComment->user->username }}さん</p>
            <p>{{ $postComment->event_at->format('Y年n月d日')}}</p>
          </div>
          <a href="/comment/edit/{{$postComment->id}}" class="post-edit-button">編集</a>
        </div>
        <div class="post-comment-2">
          <p>{{ $postComment->comment }}</p>
        </div>
        <div class="post-comment-3">
          @if(!$postComment->commentLikedBy(Auth::user()))
          <img src="{{ asset('images/heart_border.png') }}" alt="ハート" class="heart   post-count-content comment-like-toggle" data-comment-id="{{ $postComment->id }}"><p   class="post-heart">{{$postComment->post_comment_favorite_count}}</p>
          @else
          <img src="{{ asset('images/heart.png') }}" alt="ハート" class="heart post-count-content   comment-like-toggle" data-comment-id="{{ $postComment->id }}"><p class="post-heart">{{$postComment->post_comment_favorite_count}}</p>
          @endif
        </div>
      </div>
@endforeach
    </div>
  </div>
  <div id="post-detail-right">
    <div class="comment-form-position">
      <div class="comment-form">
        {!! Form::open(['url' => '/post/comment/'.$postsDetails->id]) !!}
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="post-form">
          {!! Form::textarea('comment', old('comment'), ['class' => 'input comment-area','placeholder' => 'こちらからコメントできます']) !!}
        </div>
        <button class="comment-done" type="submit"><p>投稿</p></button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>




</div>
@endsection
