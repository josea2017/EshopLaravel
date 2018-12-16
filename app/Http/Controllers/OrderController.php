<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charge;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
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
        $user = \Auth::user()->email;
        $orders = DB::table('orders')->select('id_car', 'created_at', DB::raw("SUM(price_product) as sum"))
                                     ->where('id_user', $user)
                                     ->groupBy('id_car','created_at')
                                     ->get();

         //var_dump($orders);
        return view('Order/index', ['orders' => $orders]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_car
     * @return \Illuminate\Http\Response
     */
    public function orderDetail($id_car)
    {
        $orders = DB::table('orders')->join('products', 'orders.id_product', '=', 'products.id_product')->select('orders.*', 'products.name')->where('id_car', $id_car)->get();
        return view('Order/detail', ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generateOrder($id_user){

        $user = \Auth::user()->email;
        $charges = null;
        $charges = DB::table('charges')->where('id_user', $user)->get();
        $orders = array();

        if($charges != null)
        {
            $max = sizeof($charges);
            
            for ($i=0; $i < $max; $i++) 
            {   
                $id_car = $charges[$i]->id_car;
                $id_user = $user;            
                $id_product = $charges[$i]->id_product;
                $product = DB::table('products')->where('id_product', $id_product)->get()->first();
                //$product->price
                $price = $product->price;
                $order = new Order([
                    'id_car' => $id_car,
                    'id_user' => $id_user,
                    'id_product' => $id_product,
                    'price_product' => $price
                ]);

                $stock_mayor_cero = $product->stock;
                if($stock_mayor_cero >= 1)
                {
                    array_push($orders, $order);
                    $stock_mayor_cero = $stock_mayor_cero - 1;
                    DB::table('products')->where('id_product', $id_product)->update(['stock' => $stock_mayor_cero]);
                    /*DB::table('users')
                    ->where('id', 1)
                    ->update(['votes' => 1]);*/
                }
            }
            foreach ($orders as $value) 
            {
                $value->save();
            }
            DB::table('charges')->where('id_user', $user)->delete();
            //return redirect()->route('charges.show_charge_success')->with('success', 'Data Added'); 
            return $this->index();
        }
        //return redirect()->route('charges.show_charge_success')->with('success', 'Data Added'); 
        return view('Order/index');

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
