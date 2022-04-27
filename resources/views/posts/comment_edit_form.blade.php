@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">コメント編集</p>
@endsection

@section('content')

{!! Form::open(['url' => '/comment/update/'.$commentsEditInfo->id]) !!}
<div id="post-container">
  <div class="post-content">
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
      {{ Form::label('Comment') }}
      {!! Form::textarea('comment',$commentsEditInfo->comment, ['class' => 'input post-area']) !!}
    </div>
    <button class="post-done" type="submit"><p>更新</p></button>
    <div class="detail-position">
      <a href="/comment/delete/{{$commentsEditInfo->id}}"  onclick="return confirm('このコメントを削除します。よろしいでしょうか？')" class="post-delete"><p>削除</p></a>
    </div>
    <div class="back-to-detail">
      <a href="#"  class="back-link" onclick="history.back(-1);return false;">戻る</a>
    </div>
  </div>
</div>
{!! Form::close() !!}

@endsection
