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
        Schema::create('deleted_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->date('submission_date');
            $table->string('circle');
            $table->string('region');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
            $table->string('im3_outlet_id');
            $table->string('im3_outlet_name');
            $table->string('qr_code');
            $table->string('outlet_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_partners');
    }
};
