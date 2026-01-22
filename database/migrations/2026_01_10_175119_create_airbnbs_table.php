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
        Schema::create('airbnbs', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('area_id');
            $table->integer('host_id');
            $table->integer('room_type_id');
            $table->decimal('price', 10, 2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('airbnbs');
    }
};
