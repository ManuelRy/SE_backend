<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddLockerPinHashTrigger extends Migration
{
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER hash_locker_pin_before_insert BEFORE INSERT ON lockers FOR EACH ROW
            SET NEW.pin = SHA2(NEW.pin, 256);
        ');

        DB::unprepared('
            CREATE TRIGGER hash_locker_pin_before_update BEFORE UPDATE ON lockers FOR EACH ROW
            SET NEW.pin = IF(NEW.pin <> OLD.pin, SHA2(NEW.pin, 256), OLD.pin);
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS hash_locker_pin_before_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS hash_locker_pin_before_update');
    }
}
