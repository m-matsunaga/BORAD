@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">カテゴリー追加</p>
@endsection

@section('content')

<div id="category-container">
  <div id="category-layout">
  <div class="category-form">
    {!! Form::open(['url' => '/category/main']) !!}
    <div class="main-category">
      <div class="post-form">
        {{ Form::label('新規メインカテゴリー') }}
        {{ Form::text('main',old('main'),['class' => 'input post-input']) }}
@error('main')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
      </div>
      <button class="post-done" type="submit"><p>登録</p></button>
    </div>
    {!! Form::close() !!}

    {!! Form::open(['url' => '/category/sub']) !!}
    <div class="sub-category">
      <label for="main">メインカテゴリー</label>
      <select class="post-input input" id="main-category-id" name="sub_main">
          @foreach ($mainCategories as $mainCategory)
              <option value="{{ $mainCategory->id }}">{{ $mainCategory->main_category }}</option>
          @endforeach
      </select>
@error('sub_main')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
      <div class="post-form">
        {{ Form::label('新規サブカテゴリー')}}
        {{ Form::text('sub',old('sub'),['class' => 'input post-input']) }}
@error('sub')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
      </div>
      <button class="post-done" type="submit"><p>登録</p></button>
    </div>
    {!! Form::close() !!}
  </div>
  </div>
  <div id="category-lineUp">
    <div class="add-category-lineUP">
      <p class="add-category-title">カテゴリー一覧</p>
  @foreach ($categories as $category)
    <ul class="category-ul">
      <li class="add-main-category-li">{{ $category->main_category }}
        <span class="main-category-li-span">▼</span>
    @if(in_array($category->id,array_column($mainCategoriesID,'post_main_category_id')))
    @else
        <a href="/main/{{$category->id}}/delete" onclick="return confirm('このメインカテゴリーを削除します。よろしいでしょうか？')" class="delete-main-category-a">削除</a>
    @endif
      </li>
        <ul class="add-sub-category-ul">
          @foreach ($category->PostSubCategory as $post_sub_category)
          <li class="add-sub-category-li">{{ $post_sub_category->sub_category }}
            <a href="/sub/{{$post_sub_category->id}}/delete" onclick="return confirm('このサブカテゴリーを削除します。よろしいでしょうか？')" class="delete-sub-category-a">削除</a>
          </li>
          @endforeach
        </ul>
    </ul>
  @endforeach
  </div>
  </div>
</div>


@endsection
