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

                                  <td>
                                      <img style="width: 40px; height: 40px;" class="card-img-top" src="images/clients_count.png" alt="Card image cap">
                                      Cantidad de clientes registrados:
                                  </td>
                                  <td>{{$cantClients}}</td>
                                </tr>
                                <tr>
                                  <td>
                                     <img style="width: 50px; height: 50px;" class="card-img-top" src="images/products_sales.png" alt="Card image cap">
                                     Cantidad de productos vendidos:
                                   </td>
                                  <td>{{$cantSaleProducts}}</td>
                                </tr>
                                <tr>
                                  <td>
                                      <img style="width: 50px; height: 50px;" class="card-img-top" src="images/sales.png" alt="Card image cap">
                                      Total en ventas:
                                    </td>
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
                              @if(!empty($product))
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td><img src="images/{{$product->image}}"></td>
                                        <td>{{$product->price}}</td>
                                    </tr>
                              @endif
                              @endforeach
                            </tbody>
                            </table>
                         
                    @endcan
                    @can('viewClientHome', Auth::user())
                        <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                            <thead class="table_head">
                                <tr>
                                  <td>
                                      <img style="width: 50px; height: 50px;" class="card-img-top" src="images/total_products_buy.png" alt="Card image cap">
                                      Total de productos adquiridos:
                                    </td>
                                  <td>{{$totalProductsClient}}</td>
                                </tr>
                                <tr>
                                  <td>
                                      <img style="width: 50px; height: 50px;" class="card-img-top" src="images/total_buy.png" alt="Card image cap">
                                      Monto total de compras realizadas:
                                    </td>
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
                             @if(!empty($product))
                                  <tr>
                                      <td>{{$product->name}}</td>
                                      <td><img src="images/{{$product->image}}"></td>
                                      <td>{{$product->price}}</td>
                                  </tr>
                             @endif
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
