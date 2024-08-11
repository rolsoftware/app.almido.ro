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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained()->onDelete("cascade");
            $table->string("name", 255);
            $table->string("path", 255);
            $table->string("size", 255)->nullable();
            $table->string("dimension", 255)->nullable();
            $table->integer("order")->default(0);
            $table->enum("default", ["Yes", "No"])->default("No");
            $table->enum("status", ["Active", "Inactive"])->default("Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
