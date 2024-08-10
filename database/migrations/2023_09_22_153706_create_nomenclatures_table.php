<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomenclatures', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->enum("active",['Yes','No'])->default('Yes');
            $table->timestamps();
        });

        Schema::create('nomenclature_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("nomenclature_id")->unsigned();
            $table->string("key");
            $table->string("value");
            $table->string("color")->nullable();
            $table->enum("active",['Yes','No'])->default('Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nomenclatures');
        Schema::dropIfExists('nomenclature_items');
    }
};
