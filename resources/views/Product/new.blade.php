@section('title', '- Productos Crear')
@extends('layouts.app')
@section('content')
<meta name="csrf" value="{{ csrf_token() }}">
<div class="container">
    @if(\Session::has('fail'))
       <div class="alert alert-danger">
            <p>{{ \Session::get('fail') }}</p>              
       </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Productos crear</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" enctype="multipart/form-data" action="{{ url('products') }}">
                        {{csrf_field()}}
                        <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                             <thead class="table_head">
                                <tr>
                                  <td>ID producto:</td><td><input id="id_product" type="text" class="form-control{{ $errors->has('id_product') ? ' is-invalid' : '' }}" name="id_product" style="width: 100%;" value="{{ old('id_product') }}" required autofocus></td>
                                  @if ($errors->has('id_product'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('id_product') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                <td>Nombre:</td><td><input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" style="width: 100%;" value="{{ old('name') }}" required autofocus></td>
                                  @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td>Descripción:</th><td><input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" style="width: 100%;" value="{{ old('description') }}" required autofocus></td>
                                  @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                 <tr>
                                <td>Imagen:</th><td><input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" style="width: 100%;" value="{{ old('image') }}" required autofocus></td>
                                  @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <td>Stock:</th><td><input id="stock" type="number" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" style="width: 100%;" value="{{ old('stock') }}" required autofocus></td>
                                  @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <td>Precio:</th><td><input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" style="width: 100%;" value="{{ old('price') }}" required autofocus></td>
                                  @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td>ID categoría:</td>
                                  <td>
                                      <select id="id_category" class="form-control{{ $errors->has('id_category') ? ' is-invalid' : '' }}" name="id_category" style="width: 100%;" value="{{ old('id_category') }}" required autofocus>
                                          @foreach ($categories as $category)
                                            <option value="{{$category->category_id}}">{{ $category->name }}</option>
                                          @endforeach
                                      </select>
                                      @if ($errors->has('id_category'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('id_category') }}</strong>
                                            </span>
                                        @endif
                                  </td>
                                </tr>


                                <tr>
                                  <td colspan="2">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <a class="btn btn-danger" name="cancelar" href="{{ url('products') }}">Cancelar</a>
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