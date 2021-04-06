<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->notNullable();
            $table->string('username')->unique()->notNullable();
            $table->string('accountType')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('bankAccountNumber')->nullable();
            $table->decimal('rating', $precision = 1, $scale = 1)->default(0); //0-5
            $table->integer('timesRated')->default(0);
            $table->string('cellphoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->default('user.jpeg');
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
