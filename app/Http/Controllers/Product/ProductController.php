<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->title = "Produse";
        parent::__construct('product:product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        ini_set('memory_limit', '512M');

        $filter         = $request->input('filter');
        $where          = [];
        $product        = new Product();
        $filter_page    = "product.product.filter";
        $category_list  = ProductCategory::where('status','Active')->get();

        if(!empty($filter)){

            if(isset($filter['code']) && !empty($filter['code'])) {
                $product = $product->where('code',$filter['code']);
            }

            if(isset($filter['ean']) && !empty($filter['ean'])) {
                $product = $product->where('ean',$filter['ean']);
            }

            if(isset($filter['brand']) && strlen($filter['brand']) >= 2) {
                $product = $product->where('brand','LIKE',$filter['brand'].'%');
            }

            if(isset($filter['name']) && strlen($filter['name']) >= 2) {
                $product = $product->where('name','LIKE',$filter['name'].'%');
            }

            if(isset($filter['status']) && $filter['status'] != 0) {
                $product = $product->where('status',$filter['status']);
            }

            if(isset($filter['category_id']) && !empty($filter['category_id'])) {
                $product = $product->where('category_id',$filter['category_id']);
            }

        }else{
            $where[]            = ['status','Active'];
            $filter['status']   = "Active";
        }

        $rows = $product->sortable()->paginate(10);

        return view('product.product.index',compact('filter_page','filter','category_list','where','rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_list = ProductCategory::all();
        return view('product.product.create', compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $input = $request->validated();
        $input['status'] = 'Active';
        $input['value'] = $input['price'] + ($input['price'] * $input['vat'] / 100);
        Product::create($input);

        return redirect(route('product.index'))->with('alert',['type'=>'alert-success','message'=>'Produsul a fost adaugat cu succes!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
