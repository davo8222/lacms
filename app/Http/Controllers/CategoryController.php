<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categories = Category::paginate(5);
		return view('admin.categories.category', ['categories' => $categories]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$cat_data = array();
		$rand_slug = mt_rand(0, 10000);
		$slug = '';
		if (!empty($request->input('slug')) && ($request->input('slug')) != '') {
			$slug.=$request->input('slug');
		} else {
			if (!empty($request->input('name'))) {
				$title_slug = str_slug($request->input('name'));
				$slug_exists = Category::where('slug', $title_slug)->first();
				if ($slug_exists) {
					$slug.=$slug_exists->slug . $rand_slug;
				} else {
					$slug.=$title_slug;
				}
			} else {
				$slug.= $rand_slug;
			}
		}

		$cat_data['name'] = !empty($request->input('name')) ? $request->input('name') : '';
		$cat_data['slug'] = $slug;
		$out = Category::create($cat_data);
		if (!$out) {
			return redirect()->route('allcats')->withErrors('message', 'Category coulndt be saved. try again please!');
		} else {
			return redirect()->route('allcats')->with('message', 'Category susccessfully added');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if($request->ajax()){
			$category=Category::findOrFail($id);
			$category->name=$request->input('name');
			$category->slug=$request->input('slug');
			$out=$category->update();
		}
		return response(['data' => $out, 'category'=>$category, 'status' => 'success']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$category=Category::findorFail($id);
		$category->delete();
		return redirect()->route('allcats')->with('message', 'Category susccessfully deleted');
	}
	
	/**
	 * multiremove
	 * 
	 */
	public function multidelete(Request $request) {
		if($request->ajax()){
			$ids=$request->input('data');
			$out=Category::whereIn('id', $ids)->delete(); 
		}
		return response(['data' => $out, 'status' => 'success']);
	}

}
