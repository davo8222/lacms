<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Builder;
use App\Helpers;
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
		if($post->post_type=='page'){
			$meta=new Helpers();
			$layout=$meta->get_meta($post->id, 'page_layout');
			$page_type=$meta->get_meta($post->id, 'page_type');
			$args=array('post'=>$post, 'layout'=>$layout, 'page_type'=>$page_type);
		}else{
			$args=array('post' => $post);
		}
		return view('front.single', $args)->withShortcodes();
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
