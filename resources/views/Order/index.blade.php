@section('title', '- Ordenes')
@extends('layouts.app')

@section('content')
<div class="container">
   @if(\Session::has('success'))
      <div class="alert alert-success">
           <p>{{ \Session::get('success') }}</p>              
      </div>
   @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <img style="width: 45px; height: 45px;" class="card-img-top" src="images/orders.png" alt="Card image cap">
                    Ordenes realizadas
                  </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="1">
                         <thead class="table_head">
                            <tr>
                              <th>CARRO</th>
                              <th>FECHA</th>
                              <th>TOTAL $</th>
                              <th>DETALLE</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orders as $order)
                              <tr>
                                    <td>{{$order->id_car}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->sum}}</td>
                                    <td>
                                        <a style="text-decoration: none;" class="btn btn-primary" href="/orders/detail/{{$order->id_car}}">
                                            Detalle
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection