<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  public $fillable = ['user_id','name', 'description', 'category_id', 'price', 'image', 'stock'];
  
  public function categories(){
  	return $this->belongsTo('App\Categories', 'category_id', 'id');
  }
  
  public function likes(){
    return $this->hasMany('App\Like');
  }
  
  public function likedUsers(){
    return $this->belongsToMany('App\User', 'likes');
  }
  
  public function isLikedBy($user){
    $liked_users_ids = $this->likedUsers->pluck('id');
    $result = $liked_users_ids->contains($user->id);
    return $result;
  }
  
  public function user(){
    return $this->belongsTo('App\User');
  }
}
