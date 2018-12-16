@section('title', '- Catologo Detalle')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="{{action('CarController@agregar', [Auth::user()->email, $product->id_product])}}">
                    @csrf
                    <div class="card-header">Catálogo detalle del producto</div>

                     <table class="table table-hover table-sm" style="text-align: center; margin-top: 0%;" border="0">
                             <thead class="table_head">
                                <tr>
                                  
                                  <td colspan="2">
                                    <img src="/.../../images/{{$product->image}}">
                                  </td>
                                </tr>
                                <tr>
                                  <td>ID producto:</td><td><input type="text" disabled="true" class="form-control{{ $errors->has('$product->id_product') ? ' is-invalid' : '' }}" value="{{$product->id_product}}"></td>
                                </tr>
                                <tr>
                                <td>Nombre:</td><td><input id="name" type="text" class="form-control{{ $errors->has('$product->name') ? ' is-invalid' : '' }}" name="name" style="width: 100%;" value="{{$product->name}}" required autofocus></td>
                                  @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td>Descripción:</th><td><input id="description" type="text" class="form-control{{ $errors->has('$product->description') ? ' is-invalid' : '' }}" name="description" style="width: 100%;" value="{{$product->description}}" required autofocus></td>
                                  @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                 <tr>
                                <td>Stock:</th><td><input id="stock" type="number" class="form-control{{ $errors->has('$product->stock') ? ' is-invalid' : '' }}" name="stock" style="width: 100%;" value="{{$product->stock}}" required autofocus></td>
                                  @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <td>Precio:</th><td><input id="price" type="number" class="form-control{{ $errors->has('$product->price') ? ' is-invalid' : '' }}" name="price" style="width: 100%;" value="{{$product->price}}" required autofocus></td>
                                  @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <button type="submit" class="btn btn-success" name="agregar_al_carro" value="agregar_al_carro">Agregar al carro</button>

                                    <a class="btn btn-warning" name="nuevo" href="/../cars/new/{{Auth::user()->email}}">Carro nuevo</a>

                                    <a class="btn btn-danger" name="nuevo" href="{{ URL::previous() }}">Cancelar</a>
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