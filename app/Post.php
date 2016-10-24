<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    protected $fillable=['title', 'slug', 'content', 'author_id', 'post_type', 'post_image'];
	
	
	public function user(){
		return $this->belongsTo('App\User', 'author_id');
	}
	
	public function comment(){
		return $this->hasMany('App\Comment');
	}
	
	public function category(){
		return $this->belongsTo('App\Category');
	}
}
