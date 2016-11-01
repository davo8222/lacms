<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
//use App\Meta;

use App\Helpers;

class PostsController extends Controller {

    /**
     * Display all Posts 
     * 
     * 
     */
    public function post_all() {
        $posts = Post::where('post_type', 'post')->paginate(5);
        return view('admin.posts.posts', ['posts' => $posts, 'records'=>'posts']);
    }

    /**
     * add new post
     * 
     */
    public function post_new() {
        $categories = Category::all();
		$type=$_GET['type'];
        return view('admin.posts.create', ['categories' => $categories, 'post_type'=>$type]);
    }

    /**
     * 
     * store new post
     * 
     */
    public function post_store(Request $request) {
        $post_data = array();
        $rand_slug = mt_rand(0, 10000);
        $slug_inc=1;
        $slug = '';
        if (!empty($request->input('title'))) {
            $slug = str_slug($request->input('title'));
        } else {
            $slug= $rand_slug;
        }
        $slug_exists = Post::where('slug', $slug)->first();
        if ($slug_exists) {
            $slug=$slug_exists->slug . "-$slug_inc"; 
            do{
				$slug=$slug_exists->slug . "-$slug_inc";
				$check_slug=Post::where('slug', $slug)->first();
                $slug_inc++;
            }while($check_slug);
        }
        $post_data['title'] = !empty($request->input('title')) ? $request->input('title') : '';
        $post_data['slug'] = $slug;
        $post_data['content'] = htmlspecialchars($request->input('content'));
        $post_data['author_id'] = Auth::user()->id;
        $post_data['post_type'] = !empty($request->input('post_type')) ? $request->input('post_type') : 'post';
        $post_data['post_image'] = !empty($request->input('post_image')) ? $request->input('post_image') : '';
        $out = Post::create($post_data);
        if (!$out) {
            return redirect()->route('postcreate')->withErrors('message', 'Post could not be saved. try again please!');
        } else {
            if ($post_data['post_type'] == 'page') { 
			$meta=new Helpers();
			$layout_type=!empty($request->input('sidebar_pos')) ? $request->input('sidebar_pos') : 'full';
			$meta->add_meta($out->id, 'page_layout', $layout_type);
			$page_type=!empty($request->input('page_type')) ? $request->input('page_type') : 'default';
			$meta->add_meta($out->id, 'page_page_type', $page_type);
                return redirect()->route('editpost', $out->id)->with('message', 'Page susccessfully added');
            } else {
				if($request->input('category_id')){
					$created_post=  Post::findOrFail($out->id);
					$created_post->category()->sync($request->input('category_id'));
				}
				
                return redirect()->route('editpost', $out->id)->with('message', 'Post susccessfully added');
            }
        }
    }

    /**
     * 
     * edit post
     * 
     */
    public function post_edit($post_id) {
        $post = Post::findorFail($post_id);
        $categories = Category::all();
		$meta=new Helpers();
		$layout=$meta->get_meta($post_id, 'page_layout');
		$page_type=$meta->get_meta($post_id, 'page_type');
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories, 'layout'=>$layout, 'page_type'=>$page_type]);
    }

    /**
     * 
     * edit post
     * 
     */
    public function post_update(Request $request, $post_id) {
        $post = Post::findorFail($post_id);
        $rand_slug = mt_rand(0, 10000);
		$slug_inc=1;
        $slug = '';
        if (!empty($request->input('title'))) {
            $slug = str_slug($request->input('title'));
        } else {
            $slug= $rand_slug;
        }
		if($slug!=$post->slug){
			$slug_exists = Post::where('slug', $slug)->first();
			if ($slug_exists) {
				$slug=$slug_exists->slug . "-$slug_inc"; 
				do{
					$slug=$slug_exists->slug . "-$slug_inc";
					$check_slug=Post::where('slug', $slug)->first();
					$slug_inc++;
				}while($check_slug);
			}
		}
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = $slug;
        if ($post->post_type == 'post') {
            $post->post_image = !empty($request->input('post_image')) ? $request->input('post_image') : '';
			if($request->input('category_id')){
				$post->category()->sync($request->input('category_id'));
			}
			
        }
		if($post->post_type=='page'){
			$meta=new Helpers();
			$layout_type=!empty($request->input('sidebar_pos')) ? $request->input('sidebar_pos') : 'full';
			$layout=$meta->get_meta($post->id, 'page_layout');
			if($layout!==null){
				$out=$meta->update_meta($post->id, 'page_layout', $layout_type);
			}else{
				$out=$meta->add_meta($post->id, 'page_layout', $layout_type);
			}
			$page_type=!empty($request->input('page_type')) ? $request->input('page_type') : 'full';
			$getType=$meta->get_meta($post->id, 'page_type');
			if($getType!==null){
				$out=$meta->update_meta($post->id, 'page_type', $page_type);
			}else{
				$out=$meta->add_meta($post->id, 'page_type', $page_type);
			}
		}
		$post->update();
        if ($request->input('post_type') == 'page') {
            return redirect()->route('editpost', $post->id)->with('message', 'Page susccessfully updated');
        } else {
            return redirect()->route('editpost', $post->id)->with('message', 'Post susccessfully updated');
        }
    }

    /**
     * 
     * Post delete
     * 
     */
    public function post_delete($post_id) {
        $post = Post::findorFail($post_id);
        $post->delete();
        if ($post['post_type'] == 'page') {
            return redirect()->route('allpages')->with('message', 'Page susccessfully deleted');
        } else {
            return redirect()->route('allposts')->with('message', 'Post susccessfully deleted');
        }
    }
	
	/**
	 * multiremove
	 * 
	 */
	public function multidelete(Request $request) {
		if($request->ajax()){
			$ids=$request->input('data');
			$out=Post::whereIn('id', $ids)->delete(); 
		}
		return response(['data' => $out, 'status' => 'success']);
	}
    /**
     * Display all Pages
     * 
     * 
     */
    public function page_all() {
        $posts = Post::where('post_type', 'page')->paginate(5);
        return view('admin.posts.posts', ['posts' => $posts, 'records'=>'pages']);
    }

}
