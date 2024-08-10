<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vars', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('type');
            $table->string('key', 100);
            $table->text('value')->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('active', ['Yes', 'No'])->default('Yes');
            $table->boolean('is_public')->default(1);

            $table->timestamps();

            $table->unique(['user_id','key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vars');
    }
}
