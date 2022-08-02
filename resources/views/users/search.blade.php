@extends('layouts.login')

@section('content')

<!--検索フォーム-->
<form method = "post" action = "search"><!--通信方法と検索を押された時に読み込まれるURLを指定してあげる-->
{{ csrf_field() }} <!--CSRFトークンの記述があるか確認-->
  <input name = "search" type = "text">
  <button type = "submit">検索</button>
</form>

@if(!empty($key))<!--!empty emptyでは無い時 !をつけると反転した意味になる $keyに値がある時に-->
<p>今回のワード{{$key}}</p><!--検索したワードを表示-->
@endif

<!--フォローリスト表示 foreach繰り返し-->
@foreach($userList as $userList)
<table>
  <tr>
    <td>
      <img src="{{asset('images/'.$userList->images)}}">
      {{$userList->username}}<!--登録ユーザーを表示-->
      @if(!in_array($userList->id,array_column($follow,'follow')))
      <!--in_array関数 配列に存在した値があるか確認するために使用-->
      <!--in_array $検索する値 , $配列 $follow配列の中のfollowの値がある時 -->
      <button type = "submit"><a href="/follow/{{$userList->id}}">フォロー</a></button><!--DBのfollowsテーブルにidが追加される-->
      @else
      <button type = "submit"><a href="/unfollow/{{$userList->id}}">フォローをやめる</a></button>
      @endif
    </td>
  </tr>
</table>
@endforeach

@endsection
