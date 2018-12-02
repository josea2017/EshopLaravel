@section('title', '- Categorias')
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
                <div class="card-header">Categorias</div>

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
                              <th>
                                <a class="btn btn-success" name="categoria_nueva" href="{{ url('/categories/create') }}">Categoria nueva</a>
                              </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->category_id}}</td>
                                    <td>{{$category->category_root_id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                    <td>
                                          <a style="text-decoration: none;" class="btn btn-primary" href="categories/edit/{{$category->id}}">
                                                    Editar
                                         </a>

                                          <a style="text-decoration: none;" onclick="return confirm('Do you really want to delete?');"  class="btn btn-danger" href="categories/delete/{{ $category->id }}">

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