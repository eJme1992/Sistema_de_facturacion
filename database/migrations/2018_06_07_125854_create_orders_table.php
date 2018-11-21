<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('id_empleado')->unsigned();
            $table->integer('id_cliente')->unsigned();
            $table->integer('id_type')->unsigned();
            $table->integer('monto');
            $table->integer('pago_efec');
            $table->integer('pago_tarj');
            $table->integer('descuento');
            $table->boolean('completada');
            $table->boolean('deHoy');
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
        Schema::dropIfExists('orders');
    }
}
