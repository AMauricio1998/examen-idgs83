<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            
            $table->string('nombre_clave');
            $table->string('precio');
            $table->string('cantidad');
            $table->string('total');
            $table->string('subtotal');
            $table->string('descuento');

            $table->bigInteger('id_tienda')->unsigned()->nullable();
            $table->foreign('id_tienda')->references('id')->on('tiendas');

            $table->bigInteger('id_empleado')->unsigned()->nullable();
            $table->foreign('id_empleado')->references('id')->on('empleados');
            
            $table->bigInteger('id_producto')->unsigned()->nullable();
            $table->foreign('id_producto')->references('id')->on('productos');
            
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
        Schema::dropIfExists('ventas');
    }
}
