@extends('layouts.logout')

@section('content')

<header>
  <h1 class="">登録情報確認</h1>
</header>

{!! Form::open(['url' => '/register/execute']) !!}

<div id="container">
  <div class="login-contents">
    <div class="login-form">
      <div class="form">
        <p>ユーザー名：{{ session('username') }}</p>
      </div>
      <div class="form">
        <p>メールアドレス：{{ session('email') }}</p>
      </div>
      <div class="form">
        <p>パスワード：{{ session('password') }}</p>
      </div>
      {{Form::hidden('username', session('username') )}}
      {{Form::hidden('email', session('email') )}}
      {{Form::hidden('password', session('password'))}}
      {{ Form::submit('登録',['class' => 'submit']) }}
      <div class="register-toLogin">
        <a href="/register/form" class="login-link">戻る</a>
      </div>
    </div>

  </div>
</div>

@endsection
