<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_product')->unique()->nullable(false);
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->integer('stock');
            $table->double('price');
            $table->string('id_category')->nullable(false);
            $table->timestamps();
        });
    }

    /*
     By default it's NOT NULL
    $table->string('mycolumn')->nullable(false)->change();
    id serial,  
    id_producto varchar not null primary key,
    nombre varchar not null,
    descripcion varchar not null,
    imagen bytea not null,
    stock int not null,
    precio double precision,
    id_categoria varchar not null references categorias(id_categoria)
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}