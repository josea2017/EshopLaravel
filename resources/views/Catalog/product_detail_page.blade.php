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
                                  <td>ID producto:</td><td><input type="text" readonly class="form-control-plaintext" disabled value="{{$product->id_product}}"></td>
                                </tr>
                                <tr>
                                <td>Nombre:</td><td><input type="text" readonly class="form-control-plaintext" disabled  name="name" style="width: 100%;" value="{{$product->name}}"   ></td>
                                  @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                  <td>Descripción:</th><td><input id="description" readonly class="form-control-plaintext" disabled name="description" style="width: 100%;" value="{{$product->description}}"  autofocus></td>
                                  @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                 <tr>
                                <td>Stock:</th><td><input id="stock" type="number" readonly class="form-control-plaintext" name="stock" style="width: 100%;" value="{{$product->stock}}" disabled autofocus></td>
                                  @if ($errors->has('stock'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('stock') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                                <tr>
                                <td>Precio:</th><td><input id="price" type="number" readonly class="form-control-plaintext" name="price" style="width: 100%;" value="{{$product->price}}" disabled autofocus></td>
                                  @if ($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </tr>
                               @if ($product->stock > 0)
                                <tr>
                                <td>Cantidad a  Comprar:</td><td><input id="quantity" type="number" min="1" max="99" class="form-control" name="quantity" style="width: 18%;"  value="1" autofocus>
                                   
                                </td>
                                 
                                </tr>
                                <tr>
                                <td colspan="2">
                                   @if ($errors->has('quantity'))
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </td>
                                 
                                </tr>
                               @endif
                                <tr>
                                  <td colspan="2">
                                     @if ($product->stock == 0)
                                      <span class="d-inline-block" tabindex="0" data-toggle="tooltip" data-placement="top" title="Artículo Agotado">
                                        <button class="btn btn-success" style="pointer-events: none;" type="button" disabled>Agregar al carro</button>
                                      </span>
                                    @else
                                        <button type="submit" class="btn btn-success" name="agregar_al_carro" value="agregar_al_carro">Agregar al carro</button>
                                    @endif
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
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
@endsection