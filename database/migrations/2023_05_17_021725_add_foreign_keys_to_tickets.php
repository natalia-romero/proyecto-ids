<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('functionary_id')->references('id')->on('functionaries')->constrained();
            $table->foreignId('user_id')->references('id')->on('users')->constrained();
            $table->foreignId('category_id')->references('id')->on('categories')->constrained();
            $table->foreignId('state_id')->references('id')->on('states')->constrained();
            $table->foreignId('sla_id')->references('id')->on('s_l_a_s')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['functionary_id'],['user_id'],['category_id'],['state_id'],['sla_id']);
        });
    }
};
