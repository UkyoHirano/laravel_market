@extends('layouts.logged_in')
 
@section('content')
    <h2>{{ $title }}</h2>
    <button type="button" onClick="history.back()">戻る</button>
    <h2>現在の画像</h2>
    @if($user->image !== '')
        <img src="{{ \Storage::url($user->image) }}">
    @else
        画像はありません。
    @endif
    <form
        method="POST"
        action="{{ route('users.update_image', $user) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('patch')
        <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
        </div>
        <input type="submit" value="更新">
    </form>
@endsection