<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescuentoOrdersServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_services', function (Blueprint $table) {
            $table->integer('descuento')->unsigned()->after('monto');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('orders_services', function (Blueprint $table) {
            $table->dropColumn('descuento');

        });
    }
}
