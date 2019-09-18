<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class InventoriesSeeder extends Seeder
{

    private $itemCount = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Inventory::class, $this->itemCount)->create();

        if (env('APP_DEMO') == true && File::isDirectory(public_path('images/demo'))) {
            $inventories = \DB::table('inventories')->pluck('id')->toArray();
            $path = storage_path('app/public/'.image_storage_dir());

            if(!File::isDirectory($path))
                File::makeDirectory($path);

            $directories = glob(public_path('images/demo/products/*') , GLOB_ONLYDIR);

            foreach ($inventories as $item) {
                $images = glob($directories[array_rand($directories)] . '/*.png');

                foreach ($images as $key => $img) {
                    $img_name = str_random(10) . '.png';
                    File::copy($img,  "{$path}/{$img_name}");

                    DB::table('images')->insert([
                        [
                            'name' => $img_name,
                            'path' => image_storage_dir()."/{$img_name}",
                            'extension' => 'png',
                            'size' => 0,
                            'imageable_id' => $item,
                            'imageable_type' => 'App\Inventory',
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
                }
            }
        }
    }
}
