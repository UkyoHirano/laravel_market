@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h2>{{ $title }}</h2>
  <form method="POST" action="{{ route('users.update',['user'=>\Auth::id()]) }}" enctype="multipart/form-data" >
    @csrf
    <dl>
      <dt>名前</dt>
      <dd>{{ $user->name }}</dd>
      <dt>プロフィール画像</dt>
      <dd>
        <div class="post_body_main_img">
          @if($user->image !== '')
            <img src="{{ asset('storage/' . $user->image) }}">
          @else
            <img src="{{ asset('images/no_image.png') }}">
          @endif
          <a href="{{ route('users.edit_image', $user) }}">画像を変更</a>
        </div>
      </dd>
      <dt>自己紹介文</dt>
      <dd>
        @if($user->profile !== '')
          {{ $user->profile }}
        @else
          <p>プロフィールが設定されていません。</p>
        @endif
      </dd>
      <a href="{{ route('users.edit', ['user'=>\Auth::id()])}}">プロフィール編集</a>
      
      <p>出品数：{{ $items->count() }}</p>
      
      <dt>購入履歴</dt>
      <dd>
        @forelse($user->orders as $order)
          <p>{{ $order->item->name }}：{{ $order->item->price }}円 {{ $order->item->user->name }}</p>
        @empty
          <p>購入履歴はありません。</p>
        @endforelse
      </dd>
      
    </dl>
    
  </form>
@endsection