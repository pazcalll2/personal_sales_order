<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTbOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table) {
            $table->unsignedBigInteger('tagihan_id')->nullable();

            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table) {
            $table->dropColumn('tagihan_id');
            $table->foreign('tagihan_id')->references('id')->on('tagihans')->onDelete('cascade');                    
        });
    }
}
