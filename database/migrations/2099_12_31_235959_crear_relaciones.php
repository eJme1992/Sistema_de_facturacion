<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearRelaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_uType')->references('id')->on('user_types');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('id_type')->references('id')->on('orders_type');
            $table->foreign('id_forma_pago')->references('id')->on('formas_pago');
        });
    
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('id_categoria')->references('id')->on('product_categories');
        });
        
        Schema::table('orders_products', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_producto')->references('id')->on('products');
        });
        
        Schema::table('orders_services', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('orders');
            $table->foreign('id_servicio')->references('id')->on('services');
        });
    }

    public function down()
    {
        //Schema::dropIfExists('');
    }
}