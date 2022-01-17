@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h2>{{ $title }}</h2>
  <form method="POST" action="{{ route('items.update', $item->id) }}">
	  @csrf
	  @method('patch')
	  <div>
	  	<label>
	  		商品名：<br>
	    	<input type="text" name="name" value="{{ $item->name }}">
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		商品説明：<br>
	  		<textarea name="description" rows="10" cols="50" >{{ $item->description }}</textarea>
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		価格：<br>
	  		<input type="number" name="price" value="{{ $item->price }}">
	  		円
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		カテゴリ：
	  		<select name="category_id">
	  			@foreach($categories as $category => $name)
	  				<option value="{{ $category }}" 
	  					@if( $item->category_id === $category)
	  						selected @endif >
	  					{{ $name }}
	  				</option>
	  			@endforeach
	  		</select>
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		在庫：
	  		<input type="number" name="stock" value={{ $item->stock }}>
	  	</label>
	  </div>
	  
	  <input type="submit" value="更新">
	</form>	  
@endsection