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
            if(!empty($filter['parent_id'])){
                $where[] = ['parent_id',$filter['parent_id']];
                $filter['parent_id'] = $filter['parent_id'];
            }

        }else{
            $where[] = ['status','Active'];
            $where[] = ['parent_id',0];
            $filter['status'] = "Active";
            $filter['parent_id'] = 0;
        }

        $rows = ProductCategory::where($where)->paginate(10);
        return view('product.category.index',compact('filter','where','rows'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
