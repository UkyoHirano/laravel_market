@extends('layouts.default')
 
@section('header')
<header>
    <h1 class="logo">
        <a href="{{ route('top') }}">ロゴ</a>
    </h1>
    
    <ul class="header_nav">
        <li>
            <a href="{{ route('users.show',['user'=>\Auth::id()]) }}">ユーザープロフィール</a>
        </li>
        <li>
          <a href="{{ route('likes.index') }}">
            お気に入りリスト
          </a>
        </li>
        <li>
            <a href="{{ route('items.index') }}">
            出品商品一覧
          </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
</header>
@endsection