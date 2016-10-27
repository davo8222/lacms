<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {
	protected $option;
	protected $fillable = ['key', 'value'];
	
	public function add_meda($key, $value=null) {
		$option=  $this;
		$check_option=$option->where('key', $key)->get();
		if($check_option) return false;
		$option->$key=$key;
		$option->$value=$value;
		$option->save();
	}
	public function update_meda($key, $value) {
		$option=  $this;
		$cuurent_option=$option->where('key', $key)->first();
		if(!$cuurent_option) return false;
		$cuurent_option->$value=$value;
		$cuurent_option->update();
	}
	public function get_option($key) {
		$option=  $this;
		$cuurent_option=$option->where('key', $key)->first();
		if(!$cuurent_option) return false;
		return $cuurent_option->value;
	}
	

}
