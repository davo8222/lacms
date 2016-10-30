<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Category;
use App\Builder;
use Illuminate\Support\Facades\Config;
use App\Meta;
use App\Option;

class HelperController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function to_dashboard() {

        return view('admin.index');
    }

    public function menus() {
        $menus = Builder::where('type', 'menu')->get();
        $pages = Post::where('post_type', 'page')->get();
        $categories = Category::all();
        $primary = Option::where('key', 'primary_nav')->first();
        return view('admin.builder.menu', ['menus' => $menus, 'pages' => $pages, 'categories' => $categories, 'primary_nav' => $primary]);
    }

	
    public function new_menu(Request $request) {
        if ($request->ajax()) {
            $menu = array();
            $data = $request->input('data');
            $menu['name'] = $data['name'];
            $menu['data'] = $data['items'];
            $menu['type'] = 'menu';
            if (isset($data['current_id'])) {
                $cur_menu = Builder::findOrFail($data['current_id']);
                $out = $cur_menu->update($menu);
                if (isset($data['as_primary'])) {
                    $primary_menu = Option::where('key', 'primary_nav')->first();
                    $primary_menu->value = $cur_menu->id;
                    $primary_menu->update();
                } 
            } else {
                $out = Builder::create($menu);
            }
        } else {
            echo 'nothing comes';
        }
        if ($out) {
            return response(['data' => $out, 'status' => 'success']);
        } else {
            return response(['data' => $out, 'status' => 'failed']);
        }
    }

    public function current_menu(Request $request, $menu_id) {
        if ($request->ajax()) {
            $current_menu = Builder::findOrFail($menu_id);
            $primary = Option::where('key', 'primary_nav')->first();
            $primary_id = $primary->value;
            /*
              $menus=Builder::where('type', 'menu')->get();
              $pages=Post::where('post_type', 'page')->get();
              $categories=  Category::all();
              return view('admin.builder.current_menu', ['current_menu'=>$current_menu, 'menus'=>$menus, 'pages'=>$pages, 'categories'=>$categories]);
             * 
             */
        }
        return response(['data' => $current_menu, 'as_primary' => $primary_id, 'status' => 'success']);
    }
	
	public function show_media(){
		return view('admin.upload.index');
	}

}
