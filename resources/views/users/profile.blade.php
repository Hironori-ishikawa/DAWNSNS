@extends('layouts.login')

@section('content')

<!--プロフィールページ-->
<table>
  <form method = "post" action = "profile" enctype="multipart/form-data">
    {{ csrf_field() }}

    <tr>
      <td>
        <label>username</label>
        <input type="text" name="name" value="{{$user->username}}"> <!--value元々入っている値を表示-->
      </td>
    </tr>

    <tr>
      <td>
        <label>MailAdress</label>
        <input type="text" name="mail" value="{{$user->mail}}"> <!--$user userテーブルの中のmailカラム-->
      </td>
    </tr>

    <tr>
      <td>
        <label>Password</label>
        <input type="text" name="password" value="{{$user->password}}">
      </td>
    </tr>

    <tr>
      <td>
        <label>new Password</label>
        <input type="text" name="newpassword">
      </td>
    </tr>

    <tr>
      <td>
        <label>Bio</label>
        <input type="text" name="bio" value="{{$user->bio}}">
      </td>
    </tr>

    <tr>
      <td>
        <label>Icon Image</label>
        <input type="file" name="image" value="{{$user->images}}">
      </td>
    </tr>

    <!--更新ボタン-->
    <tr>
      <td>
        <button type = "submit">更新</button>
      </td>
    </tr>

  </form>
</table>


@endsection
