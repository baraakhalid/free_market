<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('mobile', 15);
            $table->string('telephone', 15);
            $table->string('email', 45)->unique();
            $table->string('password');
            $table->string('address', 100);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('city_id')->constrained()->restrictOnDelete();

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
        Schema::dropIfExists('vendors');
    }
};
