<?php

// No WORK DONE YET

namespace App\Http\Controllers\Admin;

use DB;
use App\Product;
use App\Category;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\Validations\ExportCategoryRequest;
use App\Http\Requests\Validations\ProductUploadRequest;
use App\Http\Requests\Validations\ProductImportRequest;

class InventoryUploadController extends Controller
{

	private $failed_list = [];

	/**
	 * Show upload form
	 *
     * @return \Illuminate\Http\Response
	 */
	public function showForm()
	{
        return view('admin.product._upload_form');
	}

	/**
	 * Upload the csv file and generate the review table
	 *
	 * @param  ProductUploadRequest $request
     * @return \Illuminate\Http\Response
	 */
	public function upload(ProductUploadRequest $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		$rows[0] = array_map('strtolower', $rows[0]);
	    array_walk($rows, function(&$a) use ($rows) {
	      $a = array_combine($rows[0], $a);
	    });
	    array_shift($rows); # remove header column

        return view('admin.product.upload_review', compact('rows'));
	}

	/**
	 * Perform import action
	 *
	 * @param  ProductImportRequest $request
     * @return \Illuminate\Http\Response
	 */
	public function import(ProductImportRequest $request)
	{
        if( env('APP_DEMO') )
            return redirect()->route('admin.catalog.product.index')->with('warning', trans('messages.demo_restriction'));

		// Reset the Failed list
		$this->failed_list = [];

		foreach ($request->input('data') as $row) {
			$data = unserialize($row);

			// Ignore if the name field is not given
			if( ! $data['name'] || ! $data['categories'] ){
				$reason = $data['name'] ? trans('help.invalid_category') : trans('help.name_field_required');
				$this->pushIntoFailed($data, $reason);
				continue;
			}

			// If the slug is not given the make it
			if( ! $data['slug'] )
				$data['slug'] = str_slug($data['name'], '-');

			// Ignore if the slug is exist in the database
			$product = Product::select('slug')->where('slug', $data['slug'])->first();
			if( $product ){
				$this->pushIntoFailed($data, trans('help.slug_already_exist'));
				continue;
			}

			// Find categories and make the category_list. Ignore the row if category not found
			$data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
			if( empty($data['category_list']) ){
				$this->pushIntoFailed($data, trans('help.invalid_category'));
				continue;
			}

			// Create the product and get it, If failed then insert into the ignored list
			if( ! $this->createProduct($data) ){
				$this->pushIntoFailed($data, trans('help.input_error'));
				continue;
			}
		}

        $request->session()->flash('success', trans('messages.imported', ['model' => trans('app.products')]));

        $failed_rows = $this->getFailedList();

		if(!empty($failed_rows))
	        return view('admin.product.import_failed', compact('failed_rows'));

        return redirect()->route('admin.catalog.product.index');
	}

	/**
	 * Create Product
	 *
	 * @param  array $product
	 * @return App\Product
	 */
	private function createProduct($data)
	{
		if($data['origin_country'])
			$origin_country = DB::table('countries')->select('id')->where('iso_3166_2', strtoupper($data['origin_country']))->first();

		if($data['manufacturer'])
			$manufacturer = Manufacturer::firstOrCreate(['name' => $data['manufacturer']]);

		// Create the product
		$product = Product::create([
						'name' => $data['name'],
						'slug' => $data['slug'],
						'model_number' => $data['model_number'],
						'description' => $data['description'],
						'gtin' => $data['gtin'],
						'gtin_type' => $data['gtin_type'],
						'mpn' => $data['mpn'],
						'brand' => $data['brand'],
						'origin_country' => isset($origin_country) ? $origin_country->id : Null,
						'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : Null,
						'min_price' => ($data['minimum_price'] && $data['minimum_price'] > 0) ? $data['minimum_price'] : 0,
						'max_price' => ($data['maximum_price'] && $data['maximum_price'] > $data['minimum_price']) ? $data['maximum_price'] : Null,
						'model_number' => $data['model_number'],
						'requires_shipping' => strtoupper($data['requires_shipping']) == 'TRUE' ? 1 : 0,
						'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
					]);

		// Sync categories
		if($data['category_list'])
            $product->categories()->sync($data['category_list']);

		// Upload featured image
        if ($data['image_link'])
            $product->saveImageFromUrl($data['image_link'], true);

		// Sync tags
		if($data['tags'])
            $product->syncTags($product, explode(',', $data['tags']));

		return $product;
	}

	/**
	 * [downloadCategorySlugs]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadCategorySlugs(ExportCategoryRequest $request)
	{
		$categories = Category::select('name','slug')->get();

		return (new FastExcel($categories))->download('categories.xlsx');
	}

	/**
	 * downloadTemplate
	 *
	 * @return response response
	 */
	public function downloadTemplate()
	{
		$pathToFile = public_path("csv_templates/products.csv");

		return response()->download($pathToFile);
	}


	/**
	 * [downloadFailedRows]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadFailedRows(Request $request)
	{
		foreach ($request->input('data') as $row)
			$data[] = unserialize($row);

		return (new FastExcel(collect($data)))->download('failed_rows.xlsx');
	}

	/**
	 * Push New value Into Failed List
	 *
	 * @param  array  $data
	 * @param  str $reason
	 * @return void
	 */
	private function pushIntoFailed(array $data, $reason = Null)
	{
		$row = [
			'data' => $data,
			'reason' => $reason,
		];

		array_push($this->failed_list, $row);
	}

	/**
	 * Return the failed list
	 *
	 * @return array
	 */
	private function getFailedList()
	{
		return $this->failed_list;
	}
}
