<?php

namespace App;
use Illuminate\Http\Request;
use App\Builder;
use App\Meta;
use Illuminate\Support\Facades\DB;
class Helpers{
	
	public function show_menu() {
		$meta=new Meta();
		$menu_id=  $meta->get_meta('primary_nav');
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

