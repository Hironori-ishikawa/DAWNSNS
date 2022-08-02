<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //バリデーション(ルールを設定)
    protected function validator(array $data)
    {
        return Validator::make($data, [ //registerメソッド内の$data
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ],[
            //上の入力に対してのメッセージ入力
            'required' => 'この項目は必須です。',
            'email' => 'メールアドレスを入力して下さい。',
            'password' => '4桁以上で入力して下さい。'
        ])->validate(); //条件外の場合はこちらに表示
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([ //Userテーブルに下記の値を作成する
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']), //bcrypt dataをハッシュ化する
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){ //post通信の物があった場合
            $data = $request->input(); //入力された値を$dataに格納
            $this->validator($data); //validatorメソッド条件内の入力の場合
            $this->create($data); //createメソッドに$dataを格納

            return redirect('added')
            ->with('name', $data['username']); //$dataからusernameだけ持ってくる。入力された名前
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
