@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
<h2>{{ $title }}</h2>

	<dl class="show_item">
		<dt>商品名</dt>
		<dd>{{ $item->name }}</dd>
		
		<!--画像表示-->
		@if($item->image !== '')
			<img src="{{ asset('storage/' . $item->image) }}">
		@else
			<img src="{{ asset('images/no_image.png') }}">
		@endif
		
		<dt>カテゴリ</dt>
		<dd>{{ $item->categories->name }}</dd>
		
		<dt>価格</dt>
		<dd>{{ $item->price }}円</dd>
		
		<dt>商品説明</dt>
		<dd>{{ $item->description }}</dd>
	</dl>
<form method="POST" action="{{ route('items.confirm', $item->id) }}">
	@csrf
	@if($item->stock > 0)
		<input type="submit" value="購入する">
	@else
		<input type="submit" value="売り切れ" disabled>
	@endif
</form>

@endsection

