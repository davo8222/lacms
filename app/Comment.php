<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	
	protected $fillable=['author_id', 'content'];
	
	public function post(){
		return $this->belongsTo('App\Post');
	}
}
