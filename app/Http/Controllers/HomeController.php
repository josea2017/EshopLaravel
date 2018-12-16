<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /////// Datos para usuarios administradores //////
        $users = DB::table('users')->get();
        $cantClients =  sizeof($users);
        $orders = DB::table('orders')->get();
        $cantSaleProducts =  sizeof($orders);
        $totalSales = DB::table('orders')->sum('price_product');

        /////// Datos para usuarios clientes //////
        $user = \Auth::user()->email;
        $orders = DB::table('orders')->where('id_user', $user)->get();
        $totalProductsClient = sizeof($orders);
        $totalSalesClient = DB::table('orders')->where('id_user', $user)->sum('price_product');

        ////// Artículos adquiridos por cada cliente //////
        $ordersClient = DB::table('orders')->where('id_user', $user)->get();
        $productsClient = array();

        $max = sizeof($ordersClient);
        for ($i=0; $i < $max; $i++) { 
                $id_product = $ordersClient[$i]->id_product;
                $product = DB::table('products')->where('id_product', $id_product)->get()->first();
            array_push($productsClient, $product);
        }

        return view('home', ['cantClients' => $cantClients, 
                             'cantSaleProducts' => $cantSaleProducts, 
                             'totalSales' => $totalSales, 
                             'totalProductsClient' => $totalProductsClient,
                             'totalSalesClient' => $totalSalesClient,
                             'productsClient' => $productsClient
                    ]);

        /*
                $orders = DB::table('orders')->select('id_car', 'created_at', DB::raw("SUM(price_product) as sum"))
                                     ->where('id_user', $user)
                                     ->groupBy('id_car','created_at')
                                     ->get();
        */
    }
}
