<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Catalog/index', ['categories' => Category::orderBy('id', 'asc')->get()]);
        //return view('Catalog/index', ['categories' => Category::all()]);
        //return view('Category/index', ['categories' => Category::orderBy('id', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function products_list($id)
    {    //$users = DB::table('users')->select('name', 'email as user_email')->get();
        //$user = DB::table('users')->where('name', 'John')->first();
        //['products' => Product::all()]
       // return view('Catalog/products_list_detail', ['products' => DB::table('products')->where('id_category', $id)]);
        //return view('Catalog/products_list_detail', ['products' => DB::table('products')->select('');
        return view('Catalog/products_list_detail', ['products' => DB::table('products')->where('id_category', $id)->orderBy('id')->get()]);
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_detail($id)
    {    
       return view('Catalog/product_detail_page', ['product' => DB::table('products')->where('id_product', $id)->get()->first()]);
    }


}
