<?php

namespace App\Common;

use Illuminate\Support\Facades\Storage;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Replies
 *
 * @author Munna Khan
 */
trait Imageable {

	/**
	 * Check if model has an images.
	 *
	 * @return bool
	 */
	public function hasImages()
	{
		return (bool) $this->images()->count();
	}

	/**
	 * Return collection of images related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function images()
    {
        return $this->morphMany(\App\Image::class, 'imageable')
        ->where(function($q){
        	$q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

	/**
	 * Return the image related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function image()
    {
        return $this->morphOne(\App\Image::class, 'imageable')->orderBy('order', 'asc');
    }

	/**
	 * Return the logo related to the logoable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function logo()
    {
        return $this->morphOne(\App\Image::class, 'imageable')->where('featured','!=',1);
    }

	/**
	 * Return the bannerbg related to the banner bg img
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function bannerbg()
    {
        return $this->morphOne(\App\Image::class, 'imageable')->where('featured','!=',1);
    }

	/**
	 * Return the featured Image related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function featuredImage()
    {
        return $this->morphOne(\App\Image::class, 'imageable')->where('featured',1);
    }

	/**
     * Save images
     *
     * @param  file  $image
     *
     * @return image model
	 */
	public function saveImage($image, $featured = null)
	{
        $path = Storage::put(image_storage_dir(), $image);

        return $this->createImage($path, $image->getClientOriginalName(), $image->getClientOriginalExtension(), $image->getClientSize(), $featured);
	}

	/**
     * Save images from external URL
     *
     * @param  file  $image
     *
     * @return image model
	 */
	public function saveImageFromUrl($url, $featured = null)
	{
		// Get file info and validate
    	$file_info = get_headers($url, TRUE);
    	if( ! isset($file_info['Content-Length']) ) return;

    	// Get file size
    	$size = $file_info['Content-Length'];
    	if(is_array($size))
	    	$size =  array_key_exists(1, $size) ? $size[1] : $size[0];

    	// Get file ext
    	$extension = substr($url, strrpos($url, '.', -1) + 1);
    	$extension = in_array($extension, config('image.mime_types')) ? $extension : 'jpeg';

    	// Make path and upload
		$path = image_storage_dir() . '/' . str_random(40) . '.' . $extension;
    	Storage::put($path, file_get_contents($url));

        return $this->createImage($path, $url, $extension, $size, $featured);
	}

	/**
	 * Deletes the given image.
	 *
	 * @return bool
	 */
	public function deleteImage($image = Null)
	{
		if (!$image)
			$image = $this->image;

		if (optional($image)->path) {
	    	Storage::delete($image->path);
			Storage::deleteDirectory(image_cache_path($image->path));
		    return $image->delete();
		}

		return;
	}

	/**
	 * Deletes the Featured Image of this model.
	 *
	 * @return bool
	 */
	public function deleteFeaturedImage()
	{
		if($img = $this->featuredImage)
			$this->deleteImage($img);
		return;
	}

	/**
	 * Deletes the Brand Logo Image of this model.
	 *
	 * @return bool
	 */
	public function deleteLogo()
	{
		if($img = $this->logo)
			$this->deleteImage($img);
		return;
	}

	/**
	 * Deletes all the images of this model.
	 *
	 * @return bool
	 */
	public function flushImages()
	{
		foreach ($this->images as $image)
			$this->deleteImage($image);

		$this->deleteLogo();
		$this->deleteFeaturedImage();

		return;
	}

	/**
	 * Create image model
	 *
	 * @return array
	 */
	private function createImage($path, $name, $ext = '.jpeg', $size = Null, $featured = Null)
	{
        return $this->image()->create([
            'path' => $path,
            'name' => $name,
            'extension' => $ext,
            'featured' => (bool) $featured,
            'size' => $size,
        ]);
	}

	/**
	 * Prepare the previews for the dropzone
	 *
	 * @return array
	 */
	public function previewImages()
	{
		$urls = '';
		$configs = '';

		foreach ($this->images as $image) {
	    	Storage::url($image->path);
            $path = Storage::url($image->path);
            $deleteUrl = route('image.delete', $image->id);
            $urls .= '"' .$path . '",';
            $configs .= '{caption:"' . $image->name . '", size:' . $image->size . ', url: "' . $deleteUrl . '", key:' . $image->id . '},';
		}

		return [
			'urls' => rtrim($urls, ','),
			'configs' => rtrim($configs, ',')
		];
	}
}