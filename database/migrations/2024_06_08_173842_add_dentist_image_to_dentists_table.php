<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dentists', function (Blueprint $table) {
            $table->string('dentistImage')->nullable()->after('dentistSpeciality');
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('dentists', function (Blueprint $table) {
            $table->dropColumn('dentistImage');
        });
    }
};
