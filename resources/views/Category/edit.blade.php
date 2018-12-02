@section('title', '- Categorias Editar')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="POST" action="categories/update/{{ $category->id }}">
                    <div class="card-header">Categorias editar</div>
                    <input type="" disabled="true" name="" value="{{$category->category_id}}">
                    <input type="" disabled="true" name="" value="{{$category->category_root_id}}">
                    <input type="text" name="" value="{{$category->name}}">
                    <a class="btn btn-success" type="submit" name="editar">Editar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection