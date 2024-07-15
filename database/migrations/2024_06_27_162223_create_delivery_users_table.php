<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryUsersTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_users', function (Blueprint $table) {
            $table->id();
            // $table->string('sender');
            $table->string('receiver');
            $table->string('user_type')->default('Delivery');
            $table->string('package_size');
            // $table->string('pin_code');
            $table->string('locker_number');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_users');
    }
}
