@extends('layouts.login')

@section('content')

<h1>フォロワーリスト</h1>
<div class='follower-list'>
  @foreach ($followerLists as $followerList)
    <ul>
      <li>
        <p>{{$followerList->username}}</p>
        <!--asset使うとルートディレクトリがpublicになる-->
        <a href="followerProfile/{{$followerList->id}}">
          <img src="{{asset('images/'.$followerList->images)}}">
        </a>
      </li>
    </ul>
  @endforeach
</div>

<div class='post'>
  <table>
  @foreach($posts as $post)<!--foreach繰り返し　endforeachまで-->
    <tr>
      <td>
        <a href="followerProfile/{{$post->id}}">
          <img src="{{asset('images/'.$post->images)}}">
        </a>
      </td>
      <td>{{ $post->username }}</td>
      <td>{{ $post->posts }}</td>
      <td>{{ $post->created_at }}</td>
    </tr>
  @endforeach
  </table>
</div>
@endsection
