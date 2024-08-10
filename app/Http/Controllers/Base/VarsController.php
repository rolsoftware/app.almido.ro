<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\StoreVarRequest;
use App\Http\Requests\Base\UpdateVarRequest;
use App\Models\Vars;

class VarsController extends Controller
{
    public function __construct()
    {
        parent::__construct("app:var");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Vars::paginate(15);
        return view('base.vars.index')->with(compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('base.vars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVarRequest $request)
    {
        $input = $request->validated();
        $input['is_public'] = (!isset($input['is_public']) ? 0 : 1);
        $input['active'] = 'Yes';
        $input['user_id'] = auth()->user()->id;

        Vars::create($input);

        return redirect(route('var.index'))->with('alert',['type'=>'alert-success','message'=>'Variabila a fost adaugat cu succes!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vars $var)
    {
        return view('base.vars.show')->with(compact('var'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vars $var)
    {
        return view('base.vars.edit')->with(compact('var'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVarRequest $request, Vars $var)
    {

        $input = $request->validated();
        $input['is_public'] = (!isset($input['is_public']) ? 0 : 1);
        $input['active'] = (!isset($input['active']) ? 'No' : "Yes");
        $input['user_id'] = auth()->user()->id;
        $var->update($input); 
        
        return redirect(route('var.index'))->with('alert',['type'=>'alert-success','message'=>'Variabila a fost actualizata cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vars::where('id',$id)->delete();
        return redirect(route('var.index'))->with('alert',['type'=>'alert-success','message'=>'Variabila a fost dezactivata!']);
    }
}
