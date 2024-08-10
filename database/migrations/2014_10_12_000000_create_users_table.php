<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('avatar');
            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->rememberToken();
            $table->enum('active', ['Yes', 'No'])->default('Yes');
            $table->timestamps();
        });

        User::create([ 'username'=>'admin' , 'email' => 'admin@rolsoftware.ro', 'name' => 'Administrator', 'password' => Hash::make('12345678'), 'email_verified_at' => '2022-01-02 17:04:58', 'avatar' => 'images/avatar-1.jpg', 'created_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
