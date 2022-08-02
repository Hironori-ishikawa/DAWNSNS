<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow; //Follow::を使うために useで使えるようにする
use Auth; //Auth:: を使うために useで使えるようにする
use App\User; //User::を使うため followとfollowerメソッド
use App\Post; //Post::を使えるようにする

class FollowsController extends Controller
{
    //followList表示メソッド
    public function followList(){ //フォローリストというものに
        $followLists=User::join('follows', 'users.id', 'follows.follow')//joinテーブルの結合 第一引数followsテーブル,usersテーブルのidと,followsテーブルのfollowカラムが同じものを結合
        ->where('follower', Auth::id()) //joinで結合した中でさらにログインユーザーのidとfollowerのidが同じ条件の時
        ->select('users.*') //select()内はusersテーブルの値全ての
        ->get(); //値を取得
        $posts=Post::join('users', 'posts.user_id', 'users.id') //join内部結合 postテーブルの
        ->join('follows', 'posts.user_id', 'follows.follow') //上記の結合にさらに内部結合し
        ->where('follows.follower', '=', Auth::id()) //where文AND条件 followsテーブルのfollowerの値とログインユーザーのidがある時
        ->select('users.*', 'posts.posts', 'posts.created_at') //select()の中の値を
        ->get(); //取得する
        return view('follows.followList',['followLists'=>$followLists, 'posts'=>$posts]); //followsの中のfollowListを表示
    }

    //followerList表示メソッド
    public function followerList(){ //フォロワーリストというものに
        $followerLists=User::join('follows', 'users.id', 'follows.follower') //第一引数テーブル名follows,usersテーブルのidと,followsテーブルのfollowerカラムが同じものを結合
        ->where('follow', Auth::id()) //ログインユーザーのidとfollowのidが同じ条件の時 ←上記の結合した中でさらに条件を指定する
        ->select('users.*') //select()カラムを選択する usersの全ての値
        ->get(); //値を取得
        $posts=Post::join('users', 'posts.user_id', 'users.id')
        ->join('follows', 'posts.user_id', 'follows.follower')
        ->where('follows.follow', '=', Auth::id()) //followsテーブルのfollowとログインユーザーのidが同じ条件
        ->select('users.*', 'posts.posts', 'posts.created_at') //$postsに入る値
        ->get();
        return view('follows.followerList',['followerLists'=>$followerLists, 'posts'=>$posts]); //followsディレクトリの中のfollowerListとpostsにviewを返している
    }

    //フォローメソッド follows tableに追加
    public function follow($id){ //フォローのidについて
        Follow::insert([ //insert tableに値を追加する
            'follow' => $id, //followユーザーのidを追加
            'follower' => Auth::id(), //ログインユーザーのidを追加
        ]);
        return redirect('search'); //処理を中断しsearch画面へ遷移
    }

    //フォローを外すメソッド follows tableから削除
    public function unfollow($id){ //unfollowの機能を実行します
        Follow::where('follow', $id) //where条件文 フォローしているidに
        ->where('follower', Auth::id()) //フォロワーと認証しているidに対して
        ->delete(); //削除を実行
        return redirect('search'); //処理を中断しsearch画面へ遷移
    }

    //フォローしている人のプロフィール表示
    public function followProfile(Int $id){ //int数字型で入ってくる $idに
        $user=User::where('id', '=', $id) //Userテーブルのidと変数idの値が同じ時
        ->first(); //値を取得
        $follow = Follow::where('follower', Auth::id())
                ->get()->toArray(); //toArray配列変換 しないとエラーになる
        $posts=Post::join('users', 'posts.user_id','users.id') //第一引数 usersテーブル, postsテーブルのuser_id, usersテーブルのidを結合し
        ->where('posts.user_id', '=', $id) //postsテーブルのuser_idと$idを
        ->get(); //値を持ってくる
         return view('users.followProfile', ['user'=>$user, 'posts'=>$posts, 'follow'=>$follow]); //usersディレクトリにあるfollowProfileをviewで返している
    }

    //フォロワーのプロフィールを表示
    public function followerProfile(Int $id){ //int数字型で入ってくる $idに
        $user=User::where('id', '=', $id) //Userテーブルのidと変数idの値が同じ時
        ->first(); //値を取得
        $follow = Follow::where('follower', Auth::id())
                ->get()->toArray();
        $posts=Post::join('users', 'posts.user_id','users.id') //第一引数usersテーブル postsテーブルのuser_idとusersテーブルのidを結合
        ->where('posts.user_id', '=', $id)
        ->get();
         return view('users.followerProfile', ['user'=>$user, 'posts'=>$posts, 'follow'=>$follow]); //usersディレクトリにあるfollowerProfileをviewで返している
    }

}
