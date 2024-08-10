<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Http\Requests\Base\StoreNomenclatureRequest;
use App\Http\Requests\Base\UpdateNomenclatureRequest;
use App\Models\Nomenclature;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;


class NomenclatureController extends Controller
{

    public function __construct()
    {
        parent::__construct('app:nomenclature');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $rows = Nomenclature::paginate(15);
        return view('base.nomenclature.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('base.nomenclature.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreNomenclatureRequest $request)
    {
        $input = $request->validated();
        $input['name'] = str_replace(' ','',ucwords($input['name']));
        $input['active'] = 'Yes';

        Nomenclature::create($input);

        return redirect(route('nomenclature.index'))->with('alert',['type'=>'alert-success','message'=>'Nomenclatorul a fost adaugat cu succes!']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Nomenclature $nomenclature)
    {
        $rows = $nomenclature->items()->paginate(15);

        return view('base.nomenclature.index',compact('rows','nomenclature'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Nomenclature  $nomenclature)
    {
        return view('base.nomenclature.edit',compact('nomenclature'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateNomenclatureRequest $request, $nomenclature_id)
    {
        $input = $request->validated();

        $nomenclature = Nomenclature::find($nomenclature_id);
        $nomenclature->update($input);

        return redirect(route('nomenclature.index'))->with('alert',['type'=>'alert-success','message'=>'Nomenclatorul a fost modificat cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Nomenclature  $nomenclature)
    {
        $nomenclature->update(['active'=>'No']);
        return redirect(route('nomenclature.index'))->with('alert',['type'=>'alert-success','message'=>'Nomenclatorul a fost dezactivat cu succes!']);
    }
}
