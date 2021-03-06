@section('title', '- Productos')
@extends('layouts.app')

@section('content')
<div class="container">
   @if(\Session::has('success'))
      <div class="alert alert-success">
           <p>{{ \Session::get('success') }}</p>              
      </div>
   @endif
   @if(\Session::has('fail'))
      <div class="alert alert-danger">
           <p>{{ \Session::get('fail') }}</p>              
      </div>
   @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img style="width: 50px; height: 50px;" class="card-img-top" src="images/products_sales.png" alt="Card image cap">
                    Productos
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
                              <th>ID PRODUCTO</th>
                              <th>NOMBRE</th>
                              <th>DESCRIPCIÓN</th>
                              <th>IMAGEN</th>
                              <th>STOCK</th>
                              <th>PRECIO</th>
                              <th>CATEGORIA</th>
                              <th>
                                <a class="btn btn-success" name="categoria_nueva" href="{{ url('/products/create') }}">Producto nuevo</a>
                              </th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id_product}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td><img src="images/{{$product->image}}"></td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->category_name}}</td>
                                    <td>
                                          <a style="text-decoration: none;" class="btn btn-primary" href="products/edit/{{$product->id}}">
                                                    Editar
                                         </a>
                                          <a style="text-decoration: none;" class="btn btn-danger" href="products/delete/{{ $product->id }}">
                                                    Eliminar
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