<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Like;
use App\Item;
class LikeController extends Controller
{
    // お気に入り一覧
    public function index()
    {
        $like_items = \Auth::user()->likeItems;
        return view('likes.index', [
          'title' => 'お気に入り一覧',
          'like_items' => $like_items,
        ]);
    }
 
    // お気に入り追加処理
    public function store(Request $request)
    {
        //
    }
 
    // お気に入り削除処理
    public function destroy($id)
    {
        //
    }
}