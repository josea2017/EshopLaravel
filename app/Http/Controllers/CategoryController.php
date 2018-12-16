<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', User::class);
        return view('Category/index', ['categories' => Category::orderBy('id', 'asc')->get()]);
        //return view('Category/index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return view('Category/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        $this->authorize('view', User::class);
        $this->validate($request, [
            'category_id' => 'required', 
            'category_root_id' => 'required',
            'name' => 'required'
        ]);
        $category = new Category([
            'category_id' => $request->get('category_id'),
            'category_root_id' => $request->get('category_root_id'),
            'name' => $request->get('name')
        ]);
        try {
            $category->save();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('categories.create')->with('fail', 'Datos duplicados');  
        }
        
        return redirect()->route('categories.index')->with('success', 'Datos agregados'); 

        
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
        $this->authorize('view', User::class);
        $category = \App\Category::find($id);
        return view('Category/edit',compact('category','id'));
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
        $this->authorize('view', User::class);
        $this->validate($request, [
            'name' => 'required'
        ]);
        $category= \App\Category::find($id);
        $category->name=$request->input('name');
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Datos actualizados'); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
    {
        $this->authorize('view', User::class);
        $category = \App\Category::find($id);
        return view('Category/delete', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $this->authorize('view', User::class);
        $category = \App\Category::find($id);
        $category_id = $category->category_id;
        $product = null;
        $product = DB::table('products')->where('id_category', $category_id)->get()->first();
        if($product == null){
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'La información fue eliminada');
        }else{
            return redirect()->route('categories.index')->with('fail', 'No se logró, la categoría tiene productos asignados');
        } 
    }
}


/*
        $this->authorize('view', User::class);
        $product = \App\Product::find($id);
        $id_product = $product->id_product;
        $order = null;
        $order = DB::table('orders')->where('id_product', $id_product)->get()->first();
        if($order == null){
            $product->delete();
            return redirect()->route('products.index')->with('success', 'La información fue eliminada');
        }else{
            return redirect()->route('products.index')->with('fail', 'No se logró, el producto se encuentra en compras y es usado en estadísticas');
        }

*/