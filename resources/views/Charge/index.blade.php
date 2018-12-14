@section('title', '- Carro Compras')
@extends('layouts.app')

@section('content')
<div class="container">
   @if(\Session::has('success'))
      <div class="alert alert-success">
           <p>{{ \Session::get('success') }}</p>              
      </div>
   @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Carro de compras</div>

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
                              <th>PRECIO</th>
                              <th>
                                <a class="btn btn-success" name="generar_orden" href="#">Generar orden</a>
                              </th>
                            </tr>
                        </thead>
                        <tbody>

                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection