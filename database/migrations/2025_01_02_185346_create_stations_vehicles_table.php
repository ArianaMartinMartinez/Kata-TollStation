<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stations_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_station');
            $table->unsignedBigInteger('id_vehicle');
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('id_station')->references('id')->on('stations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_vehicle')->references('id')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stations_vehicles');
    }
};
