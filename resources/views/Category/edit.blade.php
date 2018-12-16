@section('title', '- Categorias Editar')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{action('CategoryController@edit', $category->id)}}">
                    @csrf
                    <div class="card-header">Categorias editar</div>
                    <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                        <thead class="table_head">
                            <tr>
                              <td>Categoría ID:</td>
                              <td>
                                <input readonly class="form-control-plaintext" type="" disabled="true" class="form-control" name="" value="{{$category->category_id}}">
                              </td>
                            </tr>
                            <tr>
                              <td>Raíz:</td>
                              <td>
                                <input readonly class="form-control-plaintext" type="" disabled="true" class="form-control" name="" value="{{$category->category_root_id}}">  
                              </td>
                            </tr>
                            <tr>
                              <td>Nombre:</td>
                              <td>
                                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                  <button type="submit" class="btn btn-success" style="margin-left:38px">       Editar
                                  </button>
                                  <a class="btn btn-danger" name="cancelar" href="{{ url('categories') }}">     Cancelar
                                  </a>
                              </td>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection