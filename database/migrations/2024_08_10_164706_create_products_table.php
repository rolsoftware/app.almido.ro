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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer("category_id")->unsigned()->nullable();
            $table->string("code", 64)->unique();
            $table->string("ean", 255)->unique();
            $table->string("brand", 255);
            $table->string("name", 255);
            $table->longText("description");
            $table->decimal("price", 10, 2)->default(0);
            $table->decimal("vat", 10, 2)->default(0);
            $table->decimal("value", 10, 2)->default(0);
            $table->enum("status", ["Active", "Inactive"])->default("Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
