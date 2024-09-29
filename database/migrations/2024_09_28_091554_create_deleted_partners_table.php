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
            $table->string('alasan');
            $table->date('submission_date')->nullable();
            $table->string('circle')->nullable();
            $table->string('region')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan_unik')->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->string('im3_outlet_id')->nullable();
            $table->string('im3_outlet_name')->nullable();
            $table->string('3id_qr_code')->nullable();
            $table->string('3id_outlet_name')->nullable();
            $table->string('service')->nullable();
            $table->string('branding')->nullable();
            $table->string('post_paid')->nullable();
            $table->string('pks')->nullable();
            $table->string('upload_branding')->nullable();
            $table->string('name_owner')->nullable();
            $table->string('nik_owner')->nullable();
            $table->string('npwp_owner')->nullable();
            $table->string('email_owner')->nullable();
            $table->string('im3_3id_users')->nullable();
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
