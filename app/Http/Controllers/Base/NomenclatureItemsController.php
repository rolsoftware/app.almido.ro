<?php

namespace App\Http\Controllers\Base;
use App\Http\Controllers\Controller;
use App\Http\Requests\Base\StoreNomenclatureItemRequest;
use App\Http\Requests\Base\UpdateNomenclatureItemRequest;
use App\Models\Nomenclature;
use App\Models\NomenclatureItems;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;


class NomenclatureItemsController extends Controller
{

    public function __construct()
    {
        parent::__construct('app:nomenclature');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $nomenclature_id = $request->input('nomenclature_id');
        $nomenclature = Nomenclature::find($nomenclature_id);

        return view('base.nomenclatureitems.index',compact('nomenclature','nomenclature_id'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $nomenclature_id = $request->input('nomenclature_id');
        if(!$nomenclature_id) return redirect(route('nomenclature.index'))->with('alert',['type'=>'alert-danger','message'=>'Nomenclatorul nu a fost gasit!']);
        
        $nomenclature = Nomenclature::find($nomenclature_id);

        return view('base.nomenclatureitems.create',compact('nomenclature','nomenclature_id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreNomenclatureItemRequest $request)
    {
        $input = $request->validated();
        $input['active'] = 'Yes';
        NomenclatureItems::create($input);

        return redirect(route('nomenclatureitems.index',['nomenclature_id'=>$input['nomenclature_id']]))->with('alert',['type'=>'alert-success','message'=>'Elementul a fost adaugat cu succes!']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(NomenclatureItems $nomenclatureitem)
    {
        return view('base.nomenclatureitems.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(NomenclatureItems $nomenclatureitem)
    {
        return view('base.nomenclatureitems.edit',compact('nomenclatureitem'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateNomenclatureItemRequest $request, $nomenclatureitem_id)
    {
        $nomenclatureitem = NomenclatureItems::find($nomenclatureitem_id);
        $input = $request->validated();
        $nomenclatureitem->update($input);

        return redirect(route('nomenclatureitems.index',['nomenclature_id'=>$nomenclatureitem->nomenclature_id]))->with('alert',['type'=>'alert-success','message'=>'Elementul a fost modificat cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(NomenclatureItems  $nomenclatureitem)
    {
        $nomenclatureitem->update(['active'=>'No']);
        return redirect(route('nomenclatureitems.index',['nomenclature_id'=>$nomenclatureitem->nomenclature_id]))->with('alert',['type'=>'alert-success','message'=>'Elementul a fost dezactivat cu succes!']);
    }
}
