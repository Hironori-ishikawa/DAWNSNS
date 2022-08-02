@extends('layouts.login')

@section('content')
<h1>フォローリスト</h1>
<div class='follow-list'>
  @foreach ($followLists as $followList)
  <ul>
    <li>
      <p>{{$followList->username}}</p>
      <!--asset使うとルートディレクトリがpublicになる-->
      <a href="followProfile/{{$followList->id}}">
        <img src="{{asset('images/'.$followList->images)}}">
      </a>
    </li>
  </ul>
  @endforeach
</div>

<div class='post'>
  <table>
    @foreach($posts as $post)
      <tr>
        <td>
          <a href="followProfile/{{$post->id}}">
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
