<?php

namespace App\Http\Controllers;
use App\User;
use App\Item;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\UserImageRequest;
use App\Http\Requests\UserRequest;
// use App\Services\FileUploadService;

class UserController extends Controller
{
    // 一覧
    public function index()
    {
        //
    }
 
    // 投稿フォーム
    public function create()
    {
        //
    }
 
    // 追加処理
    public function store(Request $request)
    {
        //
    }
 
    // プロフィール
    public function show($id)
    {   
        $user = \Auth::user($id);
        $items = Item::where('user_id', \Auth::user()->id)->get();
        return view('users.show',[
    		'title' => 'プロフィール',
    		'user' => $user,
    		'items' => $items,
    	]);
    }
 
    // プロフィール編集フォーム
    public function edit($id)
    {
       $user = \Auth::user($id);
        return view('users.edit',[
    		'title' => 'プロフィール編集',
    		'user' => $user,
    	]);
    }
    
     // プロフィール更新処理
    public function update(UserRequest $request)
    {
        $user = \Auth::user();
        $user->update($request->only(['name','email','profile']));
        
        session()->flash('success', 'プロフィールを編集しました');
        
        return redirect()->route('users.show',['user' => \Auth::id()]);
    }
 
    
    // 画像変更処理
    public function editImage()
    {
        $user = \Auth::user();
        return view('users.edit_image', [
            'title' => '画像変更画面',
            'user' => $user,
        ]);
    }
    
     // 画像更新処理
    public function updateImage($id, UserImageRequest $request){
        // 画像投稿処理
        $path = '';
        $image = $request->file('image');
 
        if( isset($image) === true ){
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->store('users', 'public');
        }
        // $path = $service->saveImage($request->file('image'));
        
        $user = User::find($id);
        
        // 変更前の画像を削除
        if($user->image !== ''){
            // publicディスクから該当の投稿画像を削除
            \Storage::disk('public')->delete(\Storage::url($user->image));
        }
        
        $user->update([
            'image' => $path, //ファイル名を保存
        ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show',['user' => \Auth::id()]);
    }
 
   
    // 削除処理
    public function destroy($id)
    {
        //
    }
    
}
