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
        Schema::table('houses', function (Blueprint $table) {
            $table->foreign('user_id', 'user_house_foreign')->references('id')->on('users');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('province_id', 'province_city_foreign')->references('id')->on('provinces');
        });

        Schema::table('dues', function (Blueprint $table) {
            $table->foreign('user_id', 'user_dues_foreign')->references('id')->on('users');
            $table->foreign('dues_type_id', 'dues_type_dues_foreign')->references('id')->on('dues_types');
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('NO ACTION')->onUpdate('CASCADE');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
