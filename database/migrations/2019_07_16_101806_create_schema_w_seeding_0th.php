<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSchemaWSeeding0th extends Migration
{
    public function up()
    {
        // ref. https://stackoverflow.com/q/28787293/248616
        var $sql = <<<EOS
            CREATE OR REPLACE TABLE users (
                 id int AUTO_INCREMENT primary key,
                 name varchar(66),
                 dob date,
                 updated_at timestamp
             );
EOS;
        DB::statement($sql);
    }

    public function down()
    {
    }
}
