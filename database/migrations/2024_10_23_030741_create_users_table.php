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
            $table->string('lastname', 255);
            $table->string('firstname', 255);
            $table->string('middlename', 255);
            $table->string('email', 255)->unique();
            $table->string('phone', 100);
            $table->string('password', 300);
            $table->integer('is_verified')->default(0);
            $table->integer('is_updated')->default(0);
            $table->integer('is_active')->default(0);
            $table->integer('status')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
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
