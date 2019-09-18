<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = \DB::table('modules')->where('access', '!=', 'Super Admin')->get();

        foreach ($modules as $module)
        {
            $actions = explode(',', $module->actions);

            foreach ($actions as $action)
            {
                DB::table('permissions')->insert([
                        'module_id' => $module->id,
                        'name' => title_case($action),
                        'slug' =>  strtolower($action). '_' . snake_case($module->name),
                        'created_at' => Carbon::Now(),
                        'updated_at' => Carbon::Now(),
                    ]
                );
            }
        }

        // Demo permission_role on pivot table
        $permissions = \DB::table('permissions')->pluck('module_id','id');

        foreach ($permissions as $permission_id => $module_id)
        {
            $module = \DB::table('modules')->where('id', $module_id)->first();

            if ($module->access != 'Merchant'){
                DB::table('permission_role')->insert([
                    'permission_id' => $permission_id,
                    'role_id' => \App\Role::ADMIN,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]);
            }

            if ($module->access != 'Platform'){
                DB::table('permission_role')->insert([
                    'permission_id' => $permission_id,
                    'role_id' => \App\Role::MERCHANT,
                    'created_at' => Carbon::Now(),
                    'updated_at' => Carbon::Now(),
                ]);
            }
        }
    }
}