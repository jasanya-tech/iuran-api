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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_user_id')->constrained()->default(2);
        });
        Schema::table('houses', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('city_id')->constrained();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreignId('province_id')->constrained();
        });

        Schema::table('dues', function (Blueprint $table) {
            $table->foreignId('house_id')->constrained();
            $table->foreignId('dues_type_id')->constrained();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('house_id')->constrained()->onDelete('NO ACTION')->onUpdate('CASCADE');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('house_id')->constrained();
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
