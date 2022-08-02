<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function __construct(){

// $this->middleware('auth');
$this->middleware(function ($request, $next)
{
//ログインユーザー名
$username = Auth::user();
//フォロワーのカウント
$countFollower = Follow::where('follow', '=', Auth::id())
->count();
//フォローのカウント
$countFollow = Follow::where('follower', '=', Auth::id())
->count();

//全ビューで共通で使えるよう渡してあげる。むっちゃ素敵。
View::share('username', $username['username']);
View::share('userimage', $username['images']);
View::share('countFollower', $countFollower);
View::share('countFollow', $countFollow);

return $next($request);
});
}
}
