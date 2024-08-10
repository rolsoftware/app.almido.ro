<?php

namespace App\Http\Controllers\Base;
use App\Http\Controllers\Controller;
use App\Http\Requests\Base\StoreRoleRequest;
use App\Http\Requests\Base\UpdateRoleRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct("app:role");
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rows = Role::paginate(15);
        return view('base.roles.index')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('base.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreRoleRequest $request)
    {
        $input = $request->validated();
        Role::create($input);

        return redirect(route('role.index'))->with('alert',['type'=>'alert-success','message'=>'Rolul a fost adaugat cu succes!']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        return view('base.roles.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $input = $request->validated();
        Role::where('id',$id)->update($input);
        
        return redirect(route('role.index'))->with('alert',['type'=>'alert-success','message'=>'Rolul a fost actualizat cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('role.index'))->with('alert',['type'=>'alert-success','message'=>'Rolul a fost sters cu succes!']);
    }
}
