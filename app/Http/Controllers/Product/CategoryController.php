<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->title = "Categorii Produse";
        parent::__construct('product:category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $where = [];
        $category = new ProductCategory();


        if(!empty($filter)){
            if(isset($filter['name']) && strlen($filter['name']) >= 2) {
                $category = $category->where('name','LIKE',$filter['name'].'%');
            }

            if(isset($filter['code']) && !empty($filter['code'])) {
                $category = $category->where('code',$filter['code']);
            }

            if(isset($filter['status']) && $filter['status'] != 0) {
                $category = $category->where('status',$filter['status']);
            }

        }else{
            $where[] = ['status','Active'];
            // $where[] = ['parent_id',0];
            $filter['status'] = "Active";
            $filter['parent_id'] = 0;
        }

        $filter_page = "product.category.filter";

        $rows = $category->sortable()->paginate(10);

        return view('product.category.index',compact('filter_page','filter','where','rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_list = ProductCategory::all();
        return view('product.category.create', compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $input = $request->validated();
        $input['status'] = 'Active';
        ProductCategory::create($input);

        return redirect(route('product-category.index'))->with('alert',['type'=>'alert-success','message'=>'Categoria a fost adaugat cu succes!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        $category_list = ProductCategory::all();
        return view('product.category.edit', compact('category_list','productCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $input = $request->validated();
        $input['status'] = 'Active';
        $productCategory->update($input);

        return redirect(route('product-category.index'))->with('alert',['type'=>'alert-success','message'=>'Categoria a fost modificat cu succes!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->update(['status' => 'Inactive']);
        return redirect(route('product-category.index'))->with('alert',['type'=>'alert-success','message'=>'Categoria a fost dezactivata cu succes!']);
    }
}
