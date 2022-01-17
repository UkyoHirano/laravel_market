<?php
 
namespace App\Http\Controllers\Auth;
 
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // AuthenticatesUsers トレイトを利用
    use AuthenticatesUsers;
 
    // ログイン後はホーム画面に移動
    protected $redirectTo = '/';
 
    // ログアウト処理以外では、未ログインであることを確認
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // ログアウト後の動作をカスタマイズ
    protected function loggedOut(Request $request)
    {
        // ログイン画面にリダイレクト
        return redirect(route('login'));
    }
}
