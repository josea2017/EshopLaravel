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
                    <input type="" disabled="true" name="" value="{{$category->category_id}}">
                    <input type="" disabled="true" name="" value="{{$category->category_root_id}}">
                    <input type="text" name="name" value="{{$category->name}}">
                    <button type="submit" class="btn btn-success" style="margin-left:38px">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection