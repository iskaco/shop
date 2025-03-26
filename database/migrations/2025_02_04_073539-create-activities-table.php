<?php

use App\Isap\Framework\HttpConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id')->unique();
            $table->string('uri');
            $table->enum('method', HttpConstants::METHODS)->default(Request::METHOD_GET);
            $table->string('action');
            $table->json('middleware');
            $table->string('title');
            $table->string('description');
            $table->boolean('is_menu')->default(false);
            $table->string('icon_name');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->foreign('permission_id')->references('id')->on('permissions')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
