<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // RegisterUsers トレイトを利用
    use RegistersUsers;
 
    // ユーザー登録後はホーム画面に移動
    protected $redirectTo = '/';
 
    // 未ログインであることを確認
    public function __construct()
    {
        $this->middleware('guest');
    }
 
    // ユーザー登録フォームで用いるバリデーションルールを設定
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
 
    // ユーザーの生成処理
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile' => '',
            'image' => '',
        ]);
    }
}
