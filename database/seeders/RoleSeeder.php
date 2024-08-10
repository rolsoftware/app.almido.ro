<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['name'=>'Admin', 'guard'=>'web'],
        ];

        foreach ($rows AS $row) {
            Role::updateOrCreate(['name' => $row['name']],['guard_name'=>'web']);
        }
    }
}
