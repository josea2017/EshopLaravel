<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charge;
use App\Product;
use Illuminate\Support\Facades\DB;

class ChargeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function delete($id_product)
    {
        //$product = \App\Product::find($id_product);
        $product = DB::table('products')->where('id_product', $id_product)->get()->first();
        return view('Charge/delete',compact('product','id_product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_product)
    {
        //\App\Charge::onlyTrashed()->where('id_product', $id_product);
        //DB::table('charges')->where('id_product', $id_product)->delete();
        DB::table('charges')->where('id_product', $id_product)->delete();
        $user = \Auth::user()->email;
        return $this->show_charge_user($user);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_charge_user($id_user)
    {
        $charges = null;
        $productos_en_carro = array();
        $charges = DB::table('charges')->where('id_user', $id_user)->orderBy('id')->get();

        if($charges != null)
        {
            $max = sizeof($charges);
            for ($i=0; $i < $max; $i++) { 
                $id_product = $charges[$i]->id_product;
                $product = DB::table('products')->where('id_product', $id_product)->get()->first();
            array_push($productos_en_carro, $product);
            }
           
        }

        return view('Charge/index', ['products' => $productos_en_carro]);
    }


}
