@extends('layouts.login')

@section('pageTitle')
    <p class="page-title">新規投稿</p>
@endsection

@section('content')

{!! Form::open(['url' => '/post']) !!}
<div id="post-container">
  <div class="post-content">
    <div class="post-form">
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
      <label for="sub">Sub Category</label>
      <select class="post-input input" id="category-id" name="sub">
          @foreach ($subCategories as $subCategory)
              <option value="{{ $subCategory->id }}">{{ $subCategory->sub_category }}
              </option>
          @endforeach
      </select>
    <div class="post-form">
      {{ Form::label('Title') }}
      {{ Form::text('title',old('title'),['class' => 'input post-input']) }}
    </div>
    <div class="post-form">
      {{ Form::label('投稿内容') }}
      {!! Form::textarea('post', old('post'), ['class' => 'input post-area']) !!}
    </div>
    <button class="post-done" type="submit"><p>投稿</p></button>
  </div>
</div>
{!! Form::close() !!}

@endsection
