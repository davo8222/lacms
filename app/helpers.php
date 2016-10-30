<?php

namespace App;
use Illuminate\Http\Request;
use App\Builder;
use App\Meta;
use Illuminate\Support\Facades\DB;

class Helpers{
	
	public  function add_meta($item_id, $key, $value=null) {
		$meta=  new Meta();
		$new_meta=  array();
		$check_meta=$meta->where('item_id', $item_id)->where('key',$key)->first();
		if($check_meta){
			$this->update_meda($item_id, $key, $value);
		}else{
			$new_meta['item_id']=$item_id;
			$new_meta['key']=$key;
			$new_meta['value']=$value;
			$meta->create($new_meta);
		}	
		return FALSE;
	}
	public function update_meta($item_id, $key, $value) {
		$meta=  new Meta();
		$current_meta=$meta->where('item_id', $item_id)->where('key',$key)->first();
		//if(!$current_meta) return false;
		$current_meta->value=$value;
		$current_meta->update();
	}
	public function get_meta($item_id, $key) {
		$meta=  new Meta();
		$current_meta=$meta->where('item_id', $item_id)->where('key',$key)->first();
		if($current_meta){
			return $current_meta->value;
		}else{
			$current_meta=null;
		}
		
	}
	
	public function delete_meta($item_id, $key) {
		$meta=  new Meta();
		$current_meta=$meta->where('item_id', $item_id)->where('key',$key)->first();
		if($current_meta){
			return $current_meta->value;
		}else{
			$current_meta=null;
		}
		
	}
	
	public function show_menu() {
		$options=new Option();
		$menu_id=  $options->get_option('primary_nav');
	//	$menu=Builder::findOrFail($menu_id);
		
		$menu=DB::table('builders')->where('id', $menu_id)->get();
		if($menu){
			$menu=  json_decode($menu, true);
			$items=json_decode($menu[0]['data'], true);
			 
			//var_dump($items);
			
			echo '<ul class="main_nav list-inline nav navbar-nav">';
			foreach($items as $item){
				if($item['type']=='page'){
					$page=DB::table('posts')->where('id', $item['target'])->first();
					echo '<li class="menu-item menu-item-'.$page->id.'"><a href="/frontview/'.$page->slug.'">'.$page->title.'</a></li>';
				}elseif($item['type']=='category'){
					$category=DB::table('categories')->where('id', $item['target'])->first();
					echo '<li class="menu-item menu-item-'.$category->id.'"><a href="/frontview/'.$category->slug.'">'.$category->name.'</a></li>';
				}else{
					echo '<li class="menu-item"><a href="'.$item['target'].'">'.$item['title'].'</a></li>';
				}
				
			}
			echo "</ul>";
			
		}  else {
			echo 'create a menu';
		}
	}
}

