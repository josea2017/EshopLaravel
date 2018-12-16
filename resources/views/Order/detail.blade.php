@section('title', '- Ordenes detalle')
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
                <div class="card-header">Detalle de orden</div>

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
                              <th>USUARIO</th>
                              <th>PRODUCTO</th>
                              <th>PRECIO</th>
                              <th>FECHA</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $order)
                              <tr>
                                    <td>{{$order->id_car}}</td>
                                    <td>{{$order->id_user}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->price_product}}</td>
                                    <td>{{$order->created_at}}</td>
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