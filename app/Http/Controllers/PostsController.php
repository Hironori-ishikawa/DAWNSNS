<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;//認証でAuthを使うために必要
use Illuminate\Support\Facades\view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;

class PostsController extends Controller
{

    //一覧表示
    public function index()
    {
        $id = Auth::id(); //$idにログインユーザーのidを格納
        $list = Post::join('users', 'posts.user_id', 'users.id') //join内部結合 第一引数usersテーブル postsテーブルのuser_idとusersテーブルのidを結合し
        ->leftJoin('follows', 'follows.follow', 'posts.user_id') //followsテーブルのfollowとpostsテーブルのuser_idを結合 leftJoin外部結合 片方が空でも繋げられる
        ->where('follower', Auth::id()) //where条件文AND検索 followerテーブルのログインユーザーidと
        ->orWhere('posts.user_id', Auth::id()) //orWhere条件分OR検索 ~もしくは どちらかに該当している場合 postsテーブルのログインユーザーidを
        ->select('posts.*', 'users.username', 'users.images') //select $listに値が入っている どのidカラムを使うのかを指定
        ->groupBy('posts.id') //postsテーブルのidをグループ化し
        ->orderBy('posts.created_at', 'desc') //orderBy並びを指定するpostsテーブルのcreate_atの時間帯順に desc降順
        ->get(); //投稿を取得し
        //dd($list);
        return view('posts.index',['list'=>$list, 'id'=>$id]);//viewに表示
    }

    //SQL表記
    //SELECT posts *, users *
    //From Post
    //JOIN users ON posts user_id = users id
    //LEFT JOIN follows ON follows follow = posts user_id
    //WHERE follower = ログインユーザーid
    //OR posts user_id = ログインユーザーid
    //GROUP BY posts id
    //ORDER BY posts create_at DESC;


    //つぶやき投稿機能メソッド
    public function create(Request $request) //createの処理を作る
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([ //DB::DBファサードを使ってpostsテーブルに挿入する 下記内容を
            'posts' => $post, //newPostを新しく投稿
            'user_id' => Auth::id(), //認証するためのAuth ログインユーザーのid
            'created_at' => now(), //今の時間を入れるnow
            'updated_at' => now() //更新時間 今の時間
        ]);
        //@parm:newPosts
        return redirect('/top'); //topに表示する
    }

    //SQL表記
    //INSERT INTO posts (posts,user_id,created_at,updated_at)
    //VALUES (newPost,ログインユーザーのid,now,now)

    //つぶやき更新メソッド
    public function update(Request $request) //updateの処理を作っている リクエストファサードを使って$requestに入れている
    {
        //dd($request); ダンプアンドダイ
        $id = $request->input('id'); //引数idを取り出す $idに格納
        $up_post = $request->input('upPost'); //引数upPostを取り出す $upPostに格納
        //dd($id); //ダンプアンドダイ 止める 変数が途中まで来ているか確認できる
        DB::table('posts') //DB::DBファサードを使ってpostsテーブルに何かする
            ->where('id',$id) //DB iDカラムが$idのレコードに対して
            ->update( //上に対してアップデート処理をする
                ['posts' => $up_post,'updated_at' => now()] //アップデート内容 $up_postとupdated_atに更新した時間
            );
        return redirect('/top'); ///topのURLに遷移する
    }

    //UPDATE posts
    //SET posts = 更新された投稿
    //WHERE id = 更新したいid

    //つぶやき削除メソッド
    public function delete($id) //deleteの処理を作る
    {
        DB::table('posts') //DBのpostsテーブルに対して
        ->where('id',$id) //DB idカラムが$idのレコードに対して
        ->delete(); //delete処理をする

        return redirect('/top'); //topのURLに遷移する
    }
    //DELETE FROM posts
    //WHERE id = 削除したいid
}
