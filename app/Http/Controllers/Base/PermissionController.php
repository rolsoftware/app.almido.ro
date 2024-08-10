<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\StorePermissionRequest;
use App\Http\Requests\Base\UpdatePermissionRequest;
use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Modules\Core\Enums\CrudList;

class PermissionController extends Controller
{
    
    public function __construct()
    {
        parent::__construct("app:permission");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Permission::paginate(15);
        return view('base.permissions.index')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('base.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        $input = $request->validated();
        Permission::create($input);
        return redirect(route('permission.index'))->with('alert',['type'=>'alert-success','message'=>'Permisiunea a fost adaugata cu succes!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('base.permissions.edit')->with(compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $input = $request->validated();
        $permission->name = $input['name'];
        $permission->guard_name = $input['guard_name'];
        $permission->save();

        return redirect(route('permission.index'))->with('alert',['type'=>'alert-success','message'=>'Permisiunea a fost actualizata cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect(route('permission.index'))->with('alert',['type'=>'alert-success','message'=>'Permisiunea a fost stearsa cu succes!']);
    }
}
