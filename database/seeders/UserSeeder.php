<?php

namespace Database\Seeders;

use App\Enums\CrudList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::where('email', 'admin@rolsoftware.ro')->first();
        if(!$user){
            $user = User::create(['name' => 'admin', 'dob' => '2000-10-10', 'email' => 'admin@rolsoftware.ro', 'password' => Hash::make('12345678'), 'email_verified_at' => '2022-01-02 17:04:58', 'avatar' => 'images/avatar-1.jpg', 'created_at' => now()]);
        }

        $role = Role::where('name', 'Admin')->first();
        if(!$role){
            $this->call(RoleSeeder::class);
            $role = Role::where('name', 'Admin')->first();
        }
        
        $user->assignRole([$role->id]);



    }
}
