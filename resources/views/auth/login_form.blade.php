@extends('layouts.logout')

@section('content')

<header>
  <h1 class="">LOGIN</h1>
</header>

{!! Form::open(['route' => 'login']) !!}

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
        {{ Form::label('Mail Adress') }}
        {{ Form::text('email',old('email'),['class' => 'input']) }}
      </div>
      <div class="form">
        {{ Form::label('Password') }}
        {{ Form::password('password',['class' => 'input']) }}
      </div>
      {{ Form::submit('LOGIN',['class' => 'submit']) }}
    </div>

    <p class="to-register">
      新規ユーザー登録は<a href="/register/form" class="link-register">こちら</a>
    </p>
  </div>
</div>

@endsection
