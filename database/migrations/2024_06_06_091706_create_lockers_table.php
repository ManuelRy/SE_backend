<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_lockers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLockersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('lockers')) {
            Schema::create('lockers', function (Blueprint $table) {
                $table->id();
                $table->integer('locker_number')->unique();
                $table->enum('size', ['Small', 'Medium', 'Large']);
                $table->enum('status', ['Free', 'Rented'])->default('Free');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('pin', 255)->nullable(); // Ensure it's long enough for a hashed value
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('lockers');
    }
}
