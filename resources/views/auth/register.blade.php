@extends('layouts.logout')

@section('content')

<header>
  <h1 class="">REGISTER</h1>
</header>

{!! Form::open(['url' => '/register']) !!}

<div id="container">
  <div class="login-contents">
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="login-form">
      <div class="form">
        {{ Form::label('User Name') }}
        {{ Form::text('username',old('username'),['class' => 'input']) }}
      </div>
      <div class="form">
        {{ Form::label('Mail Adress') }}
        {{ Form::text('email',old('email'),['class' => 'input']) }}
      </div>
      <div class="form">
        {{ Form::label('Password') }}
        {{ Form::password('password',['class' => 'input']) }}
      </div>
      <div class="form">
        {{ Form::label('password comfirm') }}
        {{ Form::password('password-confirm',null,['required','class' => 'input']) }}
      </div>
      {{ Form::submit('確認',['class' => 'submit']) }}
      <div class="register-toLogin">
        <a href="/" class="login-link">ログイン画面へ</a>
      </div>
    </div>

  </div>
</div>

@endsection
