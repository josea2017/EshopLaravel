<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Charge;
use App\Order;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_user
     * @return \Illuminate\Http\Response
     */
    public function new($id_user)
    {
        $car = new Car([
                    'id_user' => $id_user
                ]);
        $car->save();
        DB::table('charges')->where('id_user', $id_user)->delete();
        return redirect()->route('catalogs.index');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id_user
     * @return \Illuminate\Http\Response
     */
    public function agregar($id_user, $id_product)
    {
        $id_car = null;
        $id_car = DB::table('cars')->where('id_user', $id_user)->max('id');
        if ($id_car == null) 
        {
            $car = new Car([
                'id_user' => $id_user
            ]);
            $car->save();
            $idReturn = DB::table('cars')->where('id_user', $id_user)->max('id');
            $product_of_car = new Charge([
                'id_car' => $idReturn,
                'id_user' => $id_user,
                'id_product' => $id_product
            ]);
            $product_of_car->save();
            return redirect()->route('catalogs.index');
        }
        if($id_car != null)
        {
            if($this->verify_car_on_orders($id_car))//si el id del carro esta disponible
            {
                $product_of_car = new Charge([
                'id_car' => $id_car,
                'id_user' => $id_user,
                'id_product' => $id_product
                ]);
                $product_of_car->save();
                return redirect()->route('catalogs.index');
            }else{
                $car = new Car([
                        'id_user' => $id_user
                    ]);
                $car->save();
                $idReturn = DB::table('cars')->where('id_user', $id_user)->max('id');
                $product_of_car = new Charge([
                    'id_car' => $idReturn,
                    'id_user' => $id_user,
                    'id_product' => $id_product
                ]);
                $product_of_car->save();
                return redirect()->route('catalogs.index');
            }

        }
        //$idReturn = DB::table('cars')->where('id_user', $id_user)->max('id');
        //return view('Catalog/test', ['idReturn' => $idReturn]);
    }

    public function verify_car_on_orders($id_car)
    {
        $value = true; //true si el carro no existe en ordenes
        $order = null;
        $order = DB::table('orders')->where('id_car', $id_car)->get()->first();
        if($order != null)
        {
            $value = false;//false si el carro ya esta en uso en ordenes
        }
        return $value;
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
}
