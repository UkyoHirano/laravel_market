@extends('layouts.logged_in')

@section('title', $title)

@section('content')

<h2>{{ $title }}</h2>

<div class="display_item">
	<a href="{{route('items.create')}}">新規出品</a>
</div>

{{--商品一覧--}}
<ul class="items">
	@forelse($items as $item)
		<div class="item">
			{{--画像表示--}}
			@if($item->image !== '')
				<a href="{{route('items.show', $item->id)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
			@else
				<img src="{{ asset('images/no_image.png') }}">
			@endif
			
			{{--商品名--}}
			<li>
				商品名:{{ $item->name }} {{ $item->price }}円
			</li>
			
			{{--商品説明--}}
			<li>
				{{ $item->description }}
			</li>
			
			
			{{--カテゴリ、出品時間--}}
			<li>
				カテゴリ:{{ $item->categories->name }}
				( {{ $item->created_at }} )
			</li>
			
			{{--商品在庫--}}
			@if($item->stock > 0)
				<li>出品中</li>
			@else
				<li>売り切れ</li>
			@endif
			
			{{--商品更新--}}
			<li>
				<a href="{{ route('items.edit', $item) }}">[編集]</a>
			</li>
			
			{{--商品画像更新--}}
			<li>
				<a href="{{ route('items.edit_image', $item) }}">[画像変更]</a>
			</li>
			
			{{--商品削除--}}
			<li>
				<form method="POST" class="delete" action="{{ route('items.destroy', $item) }}">
	              @csrf
	              @method('delete')
	              <input type="submit" value="削除">
	              </form>
			</li>
		</div>	
	@empty	
		<li>出品している商品はありません</li>
	@endforelse
</ul>


@endsection