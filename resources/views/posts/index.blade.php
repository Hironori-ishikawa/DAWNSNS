@extends('layouts.login')

@section('content')
<!--つぶやき入力フォーム-->
<div class="post-form-area">
    <div class='post-form-container'>
        <div class="user-icon">
            <img src="{{asset('images/'.$userimage)}}">
        </div>
        <!--フォームファサード 投稿フォーム-->
        {!! Form::open(['url' => 'posts/create']) !!} <!--web.phpに値を送る URL=>'posts/create'-->
            {{ Form::textarea('newPost', null, ['placeholder' => '何をつぶやこうか...?']) }}
            <div class="btn-area">
                <button type="submit" class="btn btn-success pull-right">
                    <img src="images/post.png" name="投稿">
                </button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<hr class="gray-w4">
<div class='post-area'>
    <div class="post-info-container">
    <!--DBに登録された内容をTOPに表示-->
        @foreach ($list as $list)<!--foreach繰り返し endforeachまで-->
        <div class="post-info">
            <div class="user-icon">
                <img src="{{asset('images/'.$list->images)}}">
            </div>
            <div class="user-post">
                <div class="row">
                    <span class="user-name">{{ $list->username }}</span>
                    <span class="date">{{ $list->updated_at }}</span>
                </div>
                <p class="post">{{ $list->posts }}</p>
                <div class="btn-area">
                    <tr>

                        @if($list->user_id == $id) <!--投稿のuser_idとログインユーザーのidが一致した時-->
                        <td><!--foreach分の中にある繰り返し処理の為data-targetの中身が投稿と同じ値になっている $list->id-->
                            <a class="btn btn-primary modalopen" data-target="{{$list->id}}" href=""><!-- href"" jsで処理がある為ボタンのみ-->
                                <img src="images/edit.png" name="編集">
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="/post/{{$list->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash.png" name="削除"></a>
                        </td>
                        @endif
                    </tr>

                    <!--モーダルウィンドウ foreach繰り返し表示-->
                    <div class="modal-main js-modal" id="{{$list->id}}"><!--data-targetと連動-->
                        <div class="modal-inner">
                            <div class="inner-content">
                                <p class="inner-title">更新ページ</p>
                                <!--formファサード 更新フォーム-->
                                {!! Form::open(['url' => '/post/update']) !!}<!--post/updateに値が送信される-->
                                <input type="text" name="upPost" value="{{$list->posts}}">
                                <!--hidden表示されない値の送信-->
                                <input type="hidden" name="id" value="{{$list->id}}">
                                <!--送信する値にupPostを指定-->
                                <input type="submit" value="送信">
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



@endsection
