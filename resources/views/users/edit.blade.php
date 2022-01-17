@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h2>{{ $title }}</h2>
  <form method="POST" action="{{ route('users.update',$user) }}">
	  @csrf
	  @method('patch')
	  <button type="button" onClick="history.back()">戻る</button>
	  
	  <div>
		  <label>
            名前:
            <input type="text" name="name" value="{{ $user->name }}">
      </label>
    </div>
    <div>
    <div>
		  <label>
            プロフィール:<br>
            <textarea name="profile" placeholder="内容を入力" rows="10" cols="50" >{{$user->profile}}</textarea>
      </label>
    </div>
    
    <input type="submit" value="更新">
  
  </form>
@endsection