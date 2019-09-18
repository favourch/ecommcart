<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slugs = \DB::table('categories')->pluck('slug')->toArray();
        DB::table('sliders')->insert([
            [
                'title' => NULL,
                'sub_title' => NULL,
                'link' => '/category/' . $slugs[array_rand($slugs)],
                'order' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'title' => NULL,
                'sub_title' => NULL,
                'link' => '/category/' . $slugs[array_rand($slugs)],
                'order' => 2,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'title' => 'Demo Slider',
                'sub_title' => 'You can change this',
                'link' => '/category/' . $slugs[array_rand($slugs)],
                'order' => 4,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);

        if (env('APP_DEMO') == true && File::isDirectory(public_path('images/demo'))) {
            $path = storage_path('app/public/'.image_storage_dir());

            if(!File::isDirectory($path))
                File::makeDirectory($path);

            File::copy(public_path('images/demo/sliders/1.jpg'), $path . '/slider_1.jpg');
            File::copy(public_path('images/demo/sliders/2.jpg'), $path . '/slider_2.jpg');
            File::copy(public_path('images/demo/sliders/3.jpg'), $path . '/slider_3.jpg');

            DB::table('images')->insert([
                [
                    'name' => 'slider_1.jpg',
                    'path' => image_storage_dir().'/slider_1.jpg',
                    'extension' => 'jpg',
                    'order' => 1,
                    'featured' => 1,
                    'imageable_id' => 1,
                    'imageable_type' => 'App\Slider',
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ], [
                    'name' => 'slider_2.jpg',
                    'path' => image_storage_dir().'/slider_2.jpg',
                    'extension' => 'jpg',
                    'order' => 2,
                    'featured' => 1,
                    'imageable_id' => 2,
                    'imageable_type' => 'App\Slider',
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ], [
                    'name' => 'slider_3.jpg',
                    'path' => image_storage_dir().'/slider_3.jpg',
                    'extension' => 'jpg',
                    'order' => 3,
                    'featured' => 1,
                    'imageable_id' => 3,
                    'imageable_type' => 'App\Slider',
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]
            ]);
        }
    }
}
