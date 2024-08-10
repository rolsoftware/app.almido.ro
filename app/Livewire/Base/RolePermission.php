<?php

namespace App\Livewire\Base;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class RolePermission extends Component
{
    public $name = "";
    public $permission = [];
    public $role = null;
    public $permission_check = [];

    public function render()
    {
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->role->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        foreach($this->permission as $key => $value)
        {
            $check_value = $this->permission[strtolower($key)]['id'] ?? null;
            $this->permission_check[$value['name']] = in_array($check_value, $rolePermissions) ? true : false;
        }

        return view('base.role-permission.livewire.permission',compact('rolePermissions'));
    }

    public function save()
    {
        foreach ($this->permission_check as $permission => $value) {
            if(is_array($value)){
                $permission = $permission.'.'.key($value);
                $value = $value[key($value)];
            }

            if($value){    
                $this->role->givePermissionTo($permission);
            }else{
                $this->role->revokePermissionTo($permission);
            }
        }
    }
}
