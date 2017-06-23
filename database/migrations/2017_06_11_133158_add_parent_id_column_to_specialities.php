<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdColumnToSpecialities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialities', function (Blueprint $table) {
            $table->integer('parent_id')->length(11)->unsigned()->nullable()->after('direction_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialities', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}
