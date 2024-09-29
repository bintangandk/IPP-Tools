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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('full_name');
            $table->string('type')->nullable();
            $table->string('region')->nullable();
            $table->string('teritory')->nullable();
            $table->enum('status', ['Active', 'Non Active'])->default('Active');
            $table->string('password')->nullable();
            $table->string('roles')->nullable();
            $table->enum('level', ['Admin', 'User'])->default('User');
            $table->string('img')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
