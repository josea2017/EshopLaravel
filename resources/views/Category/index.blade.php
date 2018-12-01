@extends('layouts.app')

@section('content')
<div class="container">
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
                              <th>PERTENECE</th>
                              <th>NOMBRE</th>
                              <th>
                                <a class="btn btn-success" name="categoria_nueva" href="">Categoria nueva</a>
                              </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->category_id}}</td>
                                    <td>{{$category->category_root_id}}</td>
                                    <td>{{$category->name}}</td>
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