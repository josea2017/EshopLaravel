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
use App\Category;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product/index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        
        return redirect()->route('products.index')->with('success', 'Data Added'); 
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
}
