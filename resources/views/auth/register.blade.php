@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<h2>新規ユーザー登録</h2>

<label>ユーザー名</label>
{{ Form::label('ユーザー名') }}
{{ Form::text('username',null,['class' => 'input']) }}

<label>メールアドレス</label>
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',null,['class' => 'input']) }}

<label>パスワード</label>
{{ Form::label('パスワード') }}
{{ Form::text('password',null,['class' => 'input']) }}

<label>パスワード確認</label>
{{ Form::label('パスワード確認') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}

<!--エラー文-->
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif


@endsection
