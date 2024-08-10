<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        parent::__construct("app:role");
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Role $role)
    {
        $permissions = Permission::get();

        foreach ($permissions as $key => $permission) {
            list($model,$method) = explode('-',$permission->name);
            $permissions_list[$model][$method] = array(
                'id'=>$permission->id,
                'name'=>$permission->name,
            );
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('base.role-permission.show',compact('role','permissions_list','rolePermissions'));
    }
}
