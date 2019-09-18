<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_sub_groups = \DB::table('category_sub_groups')->pluck('id')->toArray();
        DB::table('categories')->insert([
            [
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Mobile',
                'slug' => 'mobile',
                'description' => 'Mobile Phones',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Mobile Accessories',
                'slug' => 'mobile-accessories',
                'description' => 'Headphone, Adapter, Casing etc',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Laptop',
                'slug' => 'laptop',
                'description' => 'Laptop',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Desktop',
                'slug' => 'desktop',
                'description' => 'Desktop',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Tablet',
                'slug' => 'tablet',
                'description' => 'Tablet Computer and Accessories',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'TVs',
                'slug' => 'tvs',
                'description' => 'TVs and Accessories',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Home Theater System',
                'slug' => 'home-theater',
                'description' => 'Home Theater Sound System and Accessories',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Point & Shoot Camera',
                'slug' => 'pns-camera',
                'description' => 'PnS Camera and Accessories',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'DSLR',
                'slug' => 'dslr',
                'description' => 'DSLR Camera and Accessories',
                'featured' => Null,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ],[
                'category_sub_group_id' => $category_sub_groups[array_rand($category_sub_groups)],
                'name' => 'Video Camera',
                'slug' => 'video-camera',
                'description' => 'Video Camera and Accessories',
                'featured' => 1,
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);
    }
}
