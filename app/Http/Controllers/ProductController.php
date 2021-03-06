<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Image;
///////////////////////
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Category;
use App\Order;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

        $products = DB::table('products')->join('categories', 'products.id_category', '=', 'categories.category_id')->select('products.*', 'categories.name as category_name')->get();


        return view('Product/index', ['products' => $products]);
        //return view('Product/index', ['products' => Product::all()]);
        //return view('Category/index', ['categories' => Category::orderBy('id', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('view', User::class);
        return view('Product/new', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->authorize('view', User::class);
        $this->validate($request, [
            'id_product' => 'required', 
            'name' => 'required',
            'description' => 'required',
            //'image' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required',
            'price' => 'required',
            'id_category' => 'required'

        ]);

        if($request->hasFile('image')){
          $image= $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          Image::make($image)->resize(125, 125)->save( public_path('/images/' . $filename ) );
          //$response = Response::make($pic->encode('jpeg'));
          $escaped = pg_escape_bytea($image);
        };

        $product = new Product([
            'id_product' => $request->get('id_product'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $filename, 
            'stock' => $request->get('stock'), 
            'price' => $request->get('price'),
            'id_category' => $request->get('id_category')
        ]);
        echo $product;
        try {
            $product->save();
        } catch (\Illuminate\Database\QueryException $e) {
            $error = $e;
            return redirect()->route('products.create')->with('fail', $error->getMessage());  
        }
        
        return redirect()->route('products.index')->with('success', 'Datos agregados'); 
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
        $product = \App\Product::find($id);
        return view('Product/edit',compact('product','id'));
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
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);
        $product= \App\Product::find($id);
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->stock=$request->input('stock');
        $product->price=$request->input('price');
        $product->save();
        return redirect()->route('products.index')->with('success', 'Datos actualizados'); 
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
        $product = \App\Product::find($id);
        return view('Product/delete', ['product' => $product]);
        
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
    }
}
