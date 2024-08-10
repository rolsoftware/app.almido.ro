<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions_list = [
            'dashboard'         => ['list'],
            'app'               => ['list'],
            'app:nomenclature'  => ['list','create','edit','delete','export'],
            'app:user'          => ['list','create','edit','delete','export'],
            'app:permission'    => ['list','create','edit','delete','export'],
            'app:role'          => ['list','create','edit','delete','export'],
            'app:var'           => ['list','create','edit','delete','export'],
            'app:log'           => ['list'],
            'app:horizon'       => ['list'],
            'app:about'         => ['list'],
        ];

        foreach ($permissions_list as $key => $permission) {
            foreach ($permission as $keyP => $value) {
                $insert['name']          = strtolower($key."-".$value);
                $insert['guard_name']    = "web";
                Permission::updateOrCreate($insert);
            }
        }

        $admin_role = Role::where(['name' => 'Admin'])->first();
        if(!$admin_role){
            $this->call(RoleSeeder::class);
            $admin_role = Role::where(['name' => 'Admin'])->first();
        }

        $permissions = Permission::pluck('id','id')->all();
        if($admin_role){
            $admin_role->syncPermissions($permissions);
        }

    }
}
