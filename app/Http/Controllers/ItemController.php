<?php

namespace App\Http\Controllers;
use App\Item;
use App\Categories;
use App\Order;
use App\User;
use App\Like;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\ItemImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    // 出品一覧画面
    public function index()
    {
        $items = Item::where('user_id', \Auth::user()->id)->latest()->get();
        return view('items.index', [
            'title' => '出品商品一覧',
            'items' => $items,
        ]);
    }
 
    // 新規商品投稿フォーム
    public function create()
    {
        // カテゴリを取得
        $categories = Categories::orderBy('id','asc')->pluck('name', 'id');
        return view('items.create',[
        	'title' => '新規出品',
        	'categories' => $categories,
        ]);
    }
 
    // 商品追加
    public function store(ItemRequest $request)
    {
        // 画像保存
        $path = '';
        $image =$request->file('image');
        if( isset($image) === true ){
            $path = $image->store('photos', 'public');
        }
        
        Item::create([
            'user_id' => \Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path,
            'stock' => $request->stock,
        ]);
        session()->flash('success', '投稿を追加しました');
        return redirect()->route('items.index');
    }
 
    // 商品詳細
    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show',[
            'title' => '商品詳細',
            'item' => $item,
        ]);
    }
 
    // 商品編集フォーム
    public function edit($id)
    {
        $item = Item::find($id);
        if($item->user_id !== \Auth::id()){
            return redirect()->route('top')->withErrors(['商品がありません。']);
        }
        $categories = Categories::orderBy('id','asc')->pluck('name', 'id');
        return view('items.edit', [
            'title' => '出品商品編集',
            'item' => $item,
            'categories' => $categories,
        ]);
    }
 
    // 商品更新
    public function update(ItemUpdateRequest $request, $id)
    {
        $item = Item::find($id);
        $item->update($request->only(['name', 'description', 'category_id', 'price', 'stock']));
        
        session()->flash('success', '商品を編集しました');
        
        return redirect()->route('items.show', $item->id);
    }
    
    // 画像編集フォーム
    public function editImage($id)
    {
        $item = Item::find($id);
        return view('items.edit_image',[
            'title' => '画像変更画面',
            'item' => $item,
        ]);
        
    }
    
    // 画像更新処理
    public function updateImage($id, ItemImageRequest $request){
        
        //画像投稿処理
        $path = '';
        $image = $request->file('image');
        if( isset($image) === true ){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('photos', 'public');
        }
        
        $item = Item::find($id);
        
        // 変更前の画像の削除
        if($item->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        
        $item->update([
          'image' => $path,
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show', $item->id);
    }
 
    // 商品削除
    public function destroy($id)
    {
        $item = Item::find($id);
        
        // 画像の削除
        if($item->image !== ''){
            \Storage::disk('public')->delete($item->image);
            
            $item->delete();
            session()->flash('success', '商品を削除しました');
            return redirect()->route('items.index');
        }
    }
    
    // 商品購入画面
    public function confirm($id)
    {
        $item = Item::find($id);
        return view('items.confirm',[
            'title' => '購入確認',
            'item' => $item,
        ]);
    }
       
    
    // 購入確定画面
    public function finish($id)
    {
        $item = Item::find($id);
        if($item->stock <= 0){
            return redirect()->route('top')->withErrors(['在庫がありません。']);
        }
        $user = \Auth::id();
        DB::transaction(function () use($user,$item,$id) {
        Order::create(['user_id' => $user, 'item_id' => $item->id]);
        Item::where('id', $id )->decrement('stock', 1);
        });
        return view('items.finish',[
            'title' => 'ご購入ありがとうございました。',
            'item' => $item,
        ]);
    }
    
    // お気に入り処理
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        if($item->isLikedBy($user)){
            // いいねの取り消し
            $item->likes->where('user_id', $user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        } else {
            // いいねを設定
            Like::create([
                'user_id' => $user->id,
                'item_id' => $item->id,
            ]);
            \Session::flash('success', 'いいねしました');
        }
        return redirect()->route('top');
        
    }
 
}