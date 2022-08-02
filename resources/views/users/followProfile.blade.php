@extends('layouts.login')

@section('content')

<h1>
  <img src="{{asset('images/'.$user->images)}}">
  {{$user->username}}さんのプロフィール
</h1>

<form method = "post" action = "profile" enctype="multipart/form-data">
  {{ csrf_field() }}
  <label>username</label>
  <input type="text" name="name" value="{{$user->username}}">
  <!--value元々入っている値を表示-->
  <label>Bio</label>
  <input type="text" name="bio" value="{{$user->bio}}">
</form>

<table>
  <tr>
    <td>
      @if(!in_array($user->id,array_column($follow,'follow')))
      <!--in_array関数 配列に指定した値があるか確認するために使用-->
      <!--in_array $検索する値 , $配列 $follow配列の中のfollowの中に$userのidが無い時follow ある時unfollow !逆の指定-->
      <button type = "submit"><a href="/follow/{{$user->id}}">フォロー</a></button><!--DBのfollowsテーブルにidが追加される-->
      @else
      <button type = "submit"><a href="/unfollow/{{$user->id}}">フォローをやめる</a></button>
      @endif
    </td>
  </tr>
</table>

<table>
@foreach($posts as $post)<!--foreach繰り返し　endforeachまで-->
<tr>
  <td><img src="{{asset('images/'.$user->images)}}"></td>
  <td>{{ $post->posts }}</td>
  <td>{{ $post->created_at }}</td>
</tr>
@endforeach
</table>

@endsection
