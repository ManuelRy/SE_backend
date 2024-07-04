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
                $table->id('locker_id');
                $table->integer('locker_number');
                $table->enum('size', ['Small', 'Medium', 'Large']);
                $table->enum('status', ['Free', 'Rented'])->default('Free');
                $table->foreignId('pin_id')->nullable()->constrained('pin')->onDelete('cascade');; // constrained table
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('lockers');
    }
}
