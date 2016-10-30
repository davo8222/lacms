<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Builder;
class FrontController extends Controller {

	
	/**
	 * 
	 * @return post array
	 */
	public function loop_posts() {
		$posts = Post::where('post_type', 'post')->paginate(5);
		return view('front.loop', ['posts' => $posts]);
	}
	
	/**
	 * 
	 * @return post array
	 */
	public function single_post($post_slug) {
		$post = Post::where('slug', $post_slug)->first();
		return view('front.single', ['post' => $post])->withShortcodes();
	}
	
	public function get_main_nav($menu_id){
		$menu_id=  config('configuration.primary_nav');
		$menu=Builder::findOrFail($menu_id);
		if($menu){
			$out=$menu;
		}else{
			$out='menu not found';
		}
			return view('layouts.nav', ['out'=>$nav]);	
	}

}
