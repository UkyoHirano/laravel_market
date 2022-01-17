@extends('layouts.logged_in')

@section('title', $title)

@section('content')

<h2>{{ $title }}</h2>
<div class="display_item">
	<a href="{{route('items.create')}}">新規出品</a>
</div>
<ul class="items">
	
	@forelse($items as $item)
		<div class="item">	
			{{--画像表示--}}
			@if($item->image !== '')
				<a href="{{route('items.show', $item->id)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
			@else
				<img src="{{ asset('images/no_image.png') }}">
			@endif
			
			{{--商品--}}
			<li>
				商品名:{{ $item->name }} {{ $item->price }}円
			</li>
			
			<a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '♥' : '♡'}}</a>
			<form method="POST" class="like" action="{{ route('items.toggle_like', $item) }}">
				@csrf
				@method('patch')
			</form>
			
			{{--商品説明--}}
			<li>
				{{ $item->description }}
			</li>
			
			<li>
				カテゴリー:{{ $item->categories->name }}
				( {{ $item->created_at }} )
			</li>
			
			{{--商品在庫--}}
			@if($item->stock > 0)
				<p>出品中</p>
			@else
				<p>売り切れ</p>
			@endif
		</div>
		
	@empty
		<li>商品はありません</li>
	@endforelse
</ul>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>

@endsection