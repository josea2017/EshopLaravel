@section('title', '- Home')
@extends('layouts.app')

@section('content')

<img style="display: flex; position: absolute; width: 200px; height: 200px; margin-left: 8%;" class="card-img-top" src="images/informacion.png" alt="Card image cap">
<div class="container" style="background-color: #e0ebeb;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @can('view', Auth::user())<div class="card-header"><h5>Administrador</h3></div>@endcan
                @can('viewClientHome', Auth::user())<div class="card-header"><h5>Cliente</h3></div>@endcan
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('view', Auth::user())
                        <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                            <thead class="table_head">
                                <tr>
                                  <td>Cantidad de clientes registrados:</td>
                                  <td>{{$cantClients}}</td>
                                </tr>
                                <tr>
                                  <td>Cantidad de productos vendidos:</td>
                                  <td>{{$cantSaleProducts}}</td>
                                </tr>
                                <tr>
                                  <td>Total en ventas:</td>
                                  <td>{{$totalSales}}</td>
                                </tr> 
                            </thead>
                        </table>
                         <h5>Artículos adquiridos</h5>
                         <table class="table table-hover table-sm" style="text-align: center; margin-top: 5%;" border="0">
                            <thead class="table_head">
                            <tr>
                              <th>NOMBRE</th>
                              <th>IMAGEN</th>
                              <th>PRECIO</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($productsClient as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td><img src="images/{{$product->image}}"></td>
                                    <td>{{$product->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    @endcan
                    @can('viewClientHome', Auth::user())
                        <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                            <thead class="table_head">
                                <tr>
                                  <td>Total de productos adquiridos:</td>
                                  <td>{{$totalProductsClient}}</td>
                                </tr>
                                <tr>
                                  <td>Monto total de compras realizadas:</td>
                                  <td>{{$totalSalesClient}}</td>
                                </tr>
                            </thead>
                        </table>
                        <h5>Artículos adquiridos</h5>
                         <table class="table table-hover table-sm" style="text-align: center; margin-top: 5%;" border="0">
                            <thead class="table_head">
                            <tr>
                              <th>NOMBRE</th>
                              <th>IMAGEN</th>
                              <th>PRECIO</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($productsClient as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td><img src="images/{{$product->image}}"></td>
                                    <td>{{$product->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
