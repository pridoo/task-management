<?php

// database/migrations/xxxx_xx_xx_xxxxxx_make_email_nullable_in_admins_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEmailNullableInAdminsTable extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Modify the email column to allow null values
            $table->string('email')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Revert back to not nullable in case of rollback
            $table->string('email')->nullable(false)->change();
        });
    }
}
