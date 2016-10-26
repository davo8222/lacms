<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class UploadController extends Controller {

	public function index() {
		return view('admin.upload.index');
	}

	public function get_all_media() {
		$files = File::allFiles(public_path() . '/media/images');
		$data = array();
		foreach ($files as $file) {
			$data[$file->getFileName()] = str_replace('\\', '/', $file->getRelativePathName());
		}
		return response(['data' => $data, 'status' => 'success']);
	}


	/**
	 * @param Storage $storage
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|string
	 */
	public function store(Storage $storage, Request $request) {
		if ($request->isXmlHttpRequest()) {
			$image = $request->file('image');
			$slug_inc=1;
            $image_original_name= $image->getClientOriginalName();
			$image_name=  pathinfo($image_original_name, PATHINFO_FILENAME);
			$image_ext=  pathinfo($image_original_name, PATHINFO_EXTENSION);
			if(FILE::exists(public_path().'/media/images/'.$image_original_name)){
				$image_original_name=$image_name.'-'.$slug_inc.'.'.$image_ext; 
				do{
					$image_original_name=$image_name.'-'.$slug_inc.'.'.$image_ext; 
					$check_iamge=FILE::exists(public_path().'/media/images/'.$image_original_name);
					$slug_inc++;
				}while($check_iamge);
			}
			$imageUploaded = $this->uploadImage($image, $image_original_name, $storage);

			if ($imageUploaded) {
				$data = [
					'original_path' => asset('/media/images/' . $image_original_name)
				];
				return json_encode($data, JSON_UNESCAPED_SLASHES);
			}
			return "uploading failed";
		}
	}

	/**
	 * @param $image
	 * @param $imageFullName
	 * @param $storage
	 * @return mixed
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function uploadImage($image, $imageFullName, $storage) {
		$filesystem = new Filesystem;
		return $storage->disk('image')->put($imageFullName, $filesystem->get($image));
	}

	public function delete(Request $request, $media) {
		if($request->ajax()){
			$file=  public_path().'/media/images/'.$media;
			$out=File::delete($file);
		}
		return response(['data' => $out,  'status' => 'success']);
	}

}
