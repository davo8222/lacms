<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model {
	protected $meta;
	protected $fillable = ['key', 'value'];
	
	public function add_meda($key, $value=null) {
		$meta=  $this;
		$key_ex=$meta->where('key', $key)->get();
		if($key_ex) return false;
		$meta->$key=$key;
		$meta->$value=$value;
		$meta->save();
	}
	public function update_meda($key, $value) {
		$meta=  $this;
		$key_ex=$meta->where('key', $key)->first();
		if(!$key_ex) return false;
		$key_ex->$value=$value;
		$key_ex->update();
	}
	public function get_meta($key) {
		$meta=  $this;
		$key_ex=$meta->where('key', $key)->first();
		if(!$key_ex) return 'none';
		return $key_ex->value;
	}
	

}
