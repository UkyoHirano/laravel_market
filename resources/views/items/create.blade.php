@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h2>{{ $title }}</h2>
  <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
	  @csrf
	  <div>
	  	<label>
	  		商品名：<br>
	    	<input type="text" name="name">
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		商品説明：<br>
	  		<textarea name="description" rows="10" cols="50"></textarea>
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		価格：<br>
	  		<input type="number" name="price">
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		カテゴリ：
	  		<select name="category_id" {{ $errors->has('category_id') ? 'is-invalid' : '' }}>
	  			@foreach($categories as $category => $name)
	  				<option value="{{ $category }}">{{ $name }}</option>
	  			@endforeach
	  		</select>
	  	</label>
	  </div>
	 
	  	
	  <div>
	  	<label>
	  		画像を選択：
	  		<input type="file" name="image">
	  	</label>
	  </div>
	  <div>
	  	<label>
	  		在庫：
	  		<input type="number" name="stock">
	  	</label>
	  </div>
	  
	  <input type="submit" value="出品">
	  	
	</form>
@endsection

 

	  