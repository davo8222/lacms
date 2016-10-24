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
		$files = File::allFiles(public_path() . '/media');
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
			$timestamp = $this->getFormattedTimestamp();
			$savedImageName = $this->getSavedImageName($timestamp, $image);

			$imageUploaded = $this->uploadImage($image, $savedImageName, $storage);

			if ($imageUploaded) {
				$data = [
					'original_path' => asset('/media/' . $savedImageName)
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

	/**
	 * @return string
	 */
	protected function getFormattedTimestamp() {
		return str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
	}

	/**
	 * @param $timestamp
	 * @param $image
	 * @return string
	 */
	protected function getSavedImageName($timestamp, $image) {
		return $timestamp . '-' . $image->getClientOriginalName();
	}
	
	public function delete(Request $request, $media) {
		if($request->ajax()){
			$file=  public_path().'/media/'.$media;
			$out=File::delete($file);
		}
		return response(['data' => $out,  'status' => 'success']);
	}

}
