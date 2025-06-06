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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 300);
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('slug', 200);
            $table->text('description')->nullable();
            $table->string('icon', 100)->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['deleted_at', 'name']);
            $table->unique(['deleted_at', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
