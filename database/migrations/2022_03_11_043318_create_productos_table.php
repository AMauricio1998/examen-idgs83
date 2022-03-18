<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 50);
            $table->string('clave', 50);
            $table->string('imagen');
            $table->string('precio');
            $table->string('descuento');

            $table->bigInteger('id_tienda')->unsigned()->nullable();
            $table->foreign('id_tienda')->references('id')->on('tiendas');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
