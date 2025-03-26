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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('mobile', 15)->nullable()->unique();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->boolean('enable')->default(false);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['deleted_at', 'username']);
            $table->unique(['deleted_at', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
