@section('title', '- Categorias Crear')
@extends('layouts.app')

@section('content')
<div class="container">
    @if(\Session::has('fail'))
       <div class="alert alert-danger">
            <p>{{ \Session::get('fail') }}</p>              
       </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categorias crear</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('categories') }}">
                        {{csrf_field()}}
                        <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                             <thead class="table_head">
                                <tr>
                                  <td>Categoría ID:</td><td><input id="category_id" type="text" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" name="category_id" style="width: 100%;" value="{{ old('category_id') }}" required autofocus></td>
                                  @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category_id') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                 @if(sizeof($categories) == 0)
                                    <td>Categoría raíz:</td>
                                    <td>No hay categorías creadas</td>
                                 @else
                                 <tr>
                                  <td>Categoría raíz:</td>
                                  <td>
                                      <select id="category_root_id" class="form-control{{ $errors->has('category_root_id') ? ' is-invalid' : '' }}" name="category_root_id" style="width: 100%;"  autofocus>
                                        <option>No aplica</option>
                                          @foreach ($categories as $category)
                                            <option value="{{$category->category_id}}">{{ $category->name }}</option>
                                          @endforeach
                                      </select>
                                  </td>
                                </tr>
                                @endif
                                <tr>
                                  <td>Nombre:</th><td><input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" style="width: 100%;" value="{{ old('name') }}" required autofocus></td>
                                  @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <button type="submit" class="btn btn-success">
                                        Guardar
                                    </button>
                                    <a class="btn btn-danger" name="cancelar" href="{{ url('/categories') }}">Cancelar</a>
                                  </td>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection