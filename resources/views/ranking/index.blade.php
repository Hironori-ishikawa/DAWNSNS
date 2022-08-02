@extends('layouts.login')

@section('content')
<div>
    <div>
        <h1>総合フォローランキング</h1>
    </div>
    <div class='follow-list'>
        @foreach ($userList as $userList)
        <table>
        <tr>
            <td>
            <p>{{ $userList->username }}</p>
                <img src="{{asset('images/'.$userList->images)}}">
                @foreach($follows as $follow)
                    <p>{{ $follows->follows_count->orderByDesc() }};</p>
                @endforeach
            </td>
        </tr>
        </table>
        @endforeach
    </div>
    <div>
        <a href="{{ route('ranking.daily') }}">＜デイリーランキングへ＞</a>
    </div>
</div>
@endsection
