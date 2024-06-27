<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageUsersTable extends Migration
{
    public function up()
    {
        Schema::create('storage_users', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('user_type')->default('Storage');
            $table->string('storage_size');
            // $table->integer('pin_code');
            $table->integer('locker_number')->default("102");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('storage_users');
    }
}
