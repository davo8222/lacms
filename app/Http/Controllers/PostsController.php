<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Category;
class PostsController extends Controller {
	
	
	/**
	 * Display all Posts 
	 * 
	 * 
	 */
	public function post_all() {
		$posts=Post::where('post_type', 'post')->paginate(5);
		return view('admin.posts.posts', ['posts'=>$posts]);
	}

	/**
	 * add new post
	 * 
	 */
	public function post_new() {
		$categories=Category::all();
		return view('admin.posts.create', ['categories'=>$categories]);
	}
	
	/**
	 * 
	 * store new post
	 * 
	 */
	public function post_store(Request $request){
		$post_data=array();
		$rand_slug=  mt_rand(0, 10000);
		$slug='';
		if(!empty($request->input('title'))){
			$title_slug=str_slug($request->input('title'));
			$slug_exists=Post::where('slug', $title_slug)->first();
			if($slug_exists){
				$slug.=$slug_exists->slug.$rand_slug;
			}else{
				$slug.=$title_slug;
			}
		}else{
			$slug.= $rand_slug;
		}
		$post_data['title']=!empty($request->input('title')) ? $request->input('title') : '';
		$post_data['slug']=$slug;
		$post_data['content']=  htmlspecialchars($request->input('content'));
		$post_data['author_id']=Auth::user()->id;
		$post_data['post_type']=!empty($request->input('post_type')) ? $request->input('post_type') : 'post';
		$post_data['post_image']=!empty($request->input('post_image')) ? $request->input('post_image') : '';
		$out=Post::create($post_data);
		if(!$out){
			return redirect()->route('postcreate')->withErrors('message', 'Post could not be saved. try again please!');
		}else{
			if($post_data['post_type']=='page'){
				return redirect()->route('allpages')->with('message', 'Page susccessfully added');
			}else{
				return redirect()->route('allposts')->with('message', 'Post susccessfully added');
			}
			
		}
		
		
	}
	
	/**
	 * 
	 * edit post
	 * 
	 */
	
	public function post_edit($post_id){
		$post=Post::findorFail($post_id);
		$categories=Category::all();
		return view('admin.posts.edit', ['post'=>$post, 'categories'=>$categories]);
	}
	
	/**
	 * 
	 * edit post
	 * 
	 */
	
	public function post_update(Request $request, $post_id){
		$post=Post::findorFail($post_id);
		$rand_slug=  mt_rand(0, 10000);
		$rand_slug=  mt_rand(0, 10000);
		$slug='';
		if(!empty($request->input('title'))){
			$title_slug=str_slug($request->input('title'));
			$slug_exists=Post::where('slug', $title_slug)->first();
			if($slug_exists){
				$slug.=$slug_exists->slug.$rand_slug;
			}else{
				$slug.=$title_slug;
			}
		}else{
			$slug.= $rand_slug;
		}
		$post->title=$request->input('title');
		$post->content=$request->input('content');
		$post->slug=$slug;
		if($post->post_type=='post'){
			$post->post_image=!empty($request->input('post_image')) ? $request->input('post_image') : '';
		}
		$post->update();
		
		if($request->input('post_type')=='page'){
			return redirect()->route('allpages')->with('message', 'Page susccessfully updated');
		}else{
			return redirect()->route('allposts')->with('message', 'Post susccessfully updated');
		}
		
		
	}
	
	/**
	 * 
	 * Post delete
	 * 
	 */
	public function post_delete($post_id){
		$post=Post::findorFail($post_id);
		$post->delete();
		if($post['post_type']=='page'){
			return redirect()->route('allpages')->with('message', 'Page susccessfully deleted');
		}else{
			return redirect()->route('allposts')->with('message', 'Post susccessfully deleted');
		}
		
		
	}
	/**
	 * Display all Pages
	 * 
	 * 
	 */
	public function page_all() {
		$posts=Post::where('post_type', 'page')->paginate(5);
		return view('admin.posts.posts', ['posts'=>$posts]);
	}

}
