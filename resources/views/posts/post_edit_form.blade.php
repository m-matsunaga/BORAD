@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">投稿編集</p>
@endsection

@section('content')

{!! Form::open(['url' => '/post/update/'.$postsEditInfo->id]) !!}
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
      <label for="sub">Sub Category</label>
      <select class="post-input input" id="category-id" name="sub">
              <option value="{{$postsEditInfo->post_sub_category_id}}">{{$postsEditInfo->PostSubCategory->sub_category}}</option>
          @foreach ($subCategories as $subCategory)
              <option value="{{ $subCategory->id }}">{{ $subCategory->sub_category }}
              </option>
          @endforeach
      </select>
    <div class="post-form">
      {{ Form::label('Title') }}
      {{ Form::text('title',$postsEditInfo->title,['class' => 'input post-input']) }}
    </div>
    <div class="post-form">
      {{ Form::label('投稿内容') }}
      {!! Form::textarea('post',$postsEditInfo->post, ['class' => 'input post-area']) !!}
    </div>
    <button class="post-done" type="submit"><p>更新</p></button>
    <div class="detail-position">
      <a href="/post/delete/{{$postsEditInfo->id}}"  onclick="return confirm('この投稿を削除します。よろしいでしょうか？')" class="post-delete"><p>削除</p></a>
    </div>
    <div class="back-to-detail">
      <a href="#"  class="back-link" onclick="history.back(-1);return false;">戻る</a>
    </div>
  </div>
</div>
{!! Form::close() !!}

@endsection
