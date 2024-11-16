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
        Schema::create('teritory', function (Blueprint $table) {
            $table->bigIncrements('id_teritory');
            $table->string('circle')->nullable();
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('sales_area')->nullable();
            $table->string('cluster')->nullable();
            $table->string('micro_cluster')->nullable();
            $table->string('partner_teritory')->nullable();
            $table->string('partner')->nullable();
            $table->string('type')->nullable();
            $table->string('kecamatan_unik')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('mc_type')->nullable();
            $table->string('flag_prog')->nullable();
            $table->string('flag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teritory');
    }
};
