<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'id' => 1,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'About us',
                'slug' => 'about-us',
                'content' => 'About the marketplace here',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'copyright_area',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 2,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Contact us',
                'slug' => 'contact-us',
                'content' => 'Contact details. A contact form will be added automatically with this info.',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'footer_3rd_column',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 3,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Privacy policy',
                'slug' => 'privacy-policy',
                'content' => 'Privacy policy here',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'copyright_area',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 4,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Terms and condition for customer',
                'slug' => 'terms-of-use-customer',
                'content' => 'Terms and condition for customer here',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'copyright_area',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 5,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Terms and condition for merchant',
                'slug' => 'terms-of-use-merchant',
                'content' => 'Terms and condition for merchant here',
                'visibility' => \App\Page::VISIBILITY_MERCHANT,
                'published_at' => Carbon::now(),
                'position' => 'copyright_area',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 6,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Return and refund policy',
                'slug' => 'return-and-refund-policy',
                'content' => 'Return and refund policy',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'footer_1st_column',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 7,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Shipping',
                'slug' => 'shipping',
                'content' => 'Shipping details',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'footer_1st_column',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ], [
                'id' => 8,
                'author_id' => \App\Role::SUPER_ADMIN,
                'title' => 'Career',
                'slug' => 'career',
                'content' => 'Job posts',
                'visibility' => \App\Page::VISIBILITY_PUBLIC,
                'published_at' => Carbon::now(),
                'position' => 'footer_2nd_column',
                'created_at' => Carbon::Now(),
                'updated_at' => Carbon::Now(),
            ]
        ]);
    }
}
