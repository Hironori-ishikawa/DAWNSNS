<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Follow;

class UsersController extends Controller
{
    //プロフィール更新 profile.blade.php のコントローラー
    public function profile(Request $request){
         $user=Auth::user(); //変数userの中に認証しているuser
         if($request->isMethod('post')){ //if分岐 isMethod()内は通信手段を指定 post通信
             if($request->file("image")){ //if分岐
                  $fileName = $request->file("image")
             ->getClientOriginalName(); //アップロードするファイル名を取得するために使う
             $request->file('image')->storeAs('images',$fileName,'public_uploads'); //storeAsメソッド アップロードしたファイル名または任意の名前を付けたい場合
             User::where('id',Auth::id()) //Userテーブルの中のidで ログインid の情報を
             ->update([ //アップデートする(更新)する
                 'images' => $fileName, //imagesに$fileNameのデータを
             ]);
             }
             User::where('id',Auth::id()) //Userテーブルのidとログインユーザーのidが条件の時
             ->update([ //更新する
            'username' => $request->input('name'), //requestに最初に入る
            'mail' => $request->input('mail'),//input() ()内はname属性
            'password' => bcrypt($request->input('newpassword')), //bcryptでパスワードをハッシュ化
            'bio' => $request->input('bio'),
        ]);
        return redirect('profile');
         }
        return view('users.profile',['user'=>$user]);
    }


    //ユーザー検索searchメソッド
    public function search(Request $request){
        $userList=User::get();//変数$userListの中にusersテーブルの全レコードと全カラムが入ってくる。
        $follow = Follow::where('follower', Auth::id()) //followerとログインユーザーのidがある時条件の時
                ->get()->toArray(); //配列として取得する

        if($request->isMethod('post')){ //if分岐 isMethod() 括弧内は通信手段
        $key = $request->input('search'); //input('inputタグにつけたname')
        $userList = User::where('username', 'like', '%' .$key. '%') //Userテーブルのusernameから探す（like）%$key%検索した値の前後は文字が入ってもいい
                ->get();  //likeが検索で使うsqlです。%がワイルドカード曖昧検索。.は文字列連携です。
        return view('users.search', compact('userList', 'key','follow'));
        }else {
            return view('users.search',compact('userList', 'follow'));
        }
    }

}
