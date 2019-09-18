<?php

namespace App\Http\Controllers;

use App\Image;
use League\Glide\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{

    public function show(Request $request, Server $server, $path)
	{
		$this->setConfigs($request);

        return $server->getImageResponse($path, $request->all());
	}

	/**
	 * upload Image via ajax. the associated model id and other information will be provided in the request
	 *
	 * @param  Request $request
	 *
	 * @return json
	 */
	public function upload(Request $request)
	{
        // \Log::info('outer:');
        // \Log::info($request->all());
        if ($request->hasFile('images')){
			$data = [];
			$dir = image_storage_dir();
			$files = $request->file('images');

        	foreach ($files as $order => $file) {
		        $path = Storage::put($dir, $file);

				$data[] = [
		            'path' => $path,
		            'name' => $file->getClientOriginalName(),
		            // 'name' => str_slug($file->getClientOriginalName(), '-'),
		            'extension' => $file->getClientOriginalExtension(),
		            'size' => $file->getClientSize(),
		            'order' => $order
		        ];
			}

        	$model = get_qualified_model($request->input('model_name'));
        	$attachable = (new $model)->find($request->input('model_id'));

			if($attachable->images()->createMany($data)){
				return Response::json(['success' => trans('response.success')]);
			}
			else{
	            $request->session()->flash('global_msg', trans('messages.img_upload_failed'));
			}

			return Response::json(['error' => trans('responses.error')]);
        }

        return Response::json([]);
	}

	/**
	 * download Image file
	 *
	 * @param  Request    $request
	 * @param  Image $image
	 *
	 * @return file
	 */
	public function download(Request $request, Image $image)
	{
	    if (Storage::exists($image->path))
	        return Storage::download($image->path, $image->name);

		return back()->with('error', trans('messages.file_not_exist'));
	}

	/**
	 * delete Image via ajax request
	 *
	 * @param  Request    $request
	 * @param  Image $image
	 *
	 * @return json
	 */
	public function delete(Request $request, Image $image)
	{
    	$image->delete();

	    if (Storage::exists($image->path)){
	        if(Storage::delete($image->path)){
				Storage::deleteDirectory(image_cache_path($image->path));
				return Response::json(['success' => trans('response.success')]);
	        }

			return Response::json(['error' => trans('response.error')]);
	    }

		return Response::json(['error' => trans('messages.file_not_exist')]);
	}


	/**
	 * sort images order via ajax.
	 *
	 * @param  Request $request
	 *
	 * @return json
	 */
	public function sort(Request $request)
	{
        $order = $request->all();
        $images = Image::find(array_keys($order));

        foreach ($images as $image) {
        	$image->update([ 'order' => $order[$image->id] ]);
        }

		return Response::json(['success' => trans('response.success')]);
	}

	/**
	 * Set Config settings for the image manupulation
	 *
	 * @param Request $request [description]
	 */
	private function setConfigs(Request $request)
	{
		if (config('image.background_color'))
			$request->merge(['bg' => config('image.background_color')]);

		return $request;
	}
}
