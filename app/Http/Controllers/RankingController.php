<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use App\Post;
use App\User;
use Auth;
use Carbon\Carbon;

class RankingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userList = User::join('follows', 'users.id', 'follows.follow')
            ->where('follower', Auth::id())
            ->orderBy('follower', 'asc')
            ->get();
        $follows = Follow::withCount('follows')
            ->get();
        return view('ranking.index', compact('user', 'userList', 'followCount', 'follows')
        );
    }

    public function daily()
    {
        $dt = new carbon('today');

        //今日のランキングを('sum')の昇順で表示。
        $sum =\DB::table('users')
            ->join('follows', 'users.id','=','follows.follower')
            ->where('created_at', '=', $dt )
            ->orderBy('sum', 'ASC')
            ->get();
        return view('ranking.daily', compact('sum') );
    }
}
