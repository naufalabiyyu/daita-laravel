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
            $table->increments('id_user');
            $table->string('name')->length(30);
            $table->string('email')->length(30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->length(60);

            $table->longText('address_one');
            $table->longText('address_two');
            $table->integer('provinces_id')->length(20);
            $table->integer('regencies_id')->length(20);
            $table->integer('zip_code')->length(11);
            $table->string('country')->length(10);
            $table->string('phone_number')->length(15);

            $table->softDeletes();
            $table->rememberToken();
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
