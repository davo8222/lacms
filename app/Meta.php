<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model {
	protected $meta;
	protected $fillable = ['item_id', 'key', 'value'];
	
	public function add_meda($item_id, $key, $value=null) {
		$meta=  $this;
		$check_meta=$meta->where(['item_id', '=', $item_id], ['key', '=', $key])->get();
		if($check_meta) return false;
		$meta->$key=$key;
		$meta->$value=$value;
		$meta->save();
	}
	public function update_meda($item_id, $key, $value) {
		$meta=  $this;
		$current_meta=$meta->where(['item_id', '=', $item_id], ['key', '=', $key])->first();
		if(!$current_meta) return false;
		$current_meta->$value=$value;
		$current_meta->update();
	}
	public function get_meta($item_id, $key) {
		$meta=  $this;
		$current_meta=$meta->where(['item_id', '=', $item_id], ['key', '=', $key])->first();
		if(!$current_meta) return false;
		return $current_meta->value;
	}
	

}
