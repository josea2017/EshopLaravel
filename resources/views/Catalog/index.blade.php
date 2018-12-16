@section('title', '- Catalogo')
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
                    <img style="width: 50px; height: 50px;" class="card-img-top" src="images/catalog.png" alt="Card image cap">
                    Catálogo
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
                              <th>CATEGORIA ID</th>
                              <th>RAÍZ</th>
                              <th>NOMBRE</th>
                              <th>DETALLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->category_id}}</td>
                                    <td>{{$category->category_root_id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                          <a style="text-decoration: none;" class="btn btn-primary" href="../catalogs/products_list/{{$category->category_id}}">
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