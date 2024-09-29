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
            $table->date('submission_date');
            $table->string('circle');
            $table->string('region');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('kecamatan_unik');
            $table->decimal('longitude', 9, 6);
            $table->decimal('latitude', 9, 6);
            $table->string('im3_outlet_id');
            $table->string('im3_outlet_name');
            $table->string('3id_qr_code');
            $table->string('3id_outlet_name');
            $table->enum('service', ['Done', 'Not']);
            $table->enum('branding', ['Done', 'Not']);
            $table->enum('post_paid', ['Done', 'Not']);
            $table->string('pks');
            $table->string('upload_branding');
            $table->string('name_owner');
            $table->string('nik_owner');
            $table->string('npwp_owner');
            $table->string('email_owner');
            $table->integer('im3_3id_users');
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
