@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
            <a href="{{ route('users.show',['user'=>\Auth::id()]) }}">ユーザープロフィール
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