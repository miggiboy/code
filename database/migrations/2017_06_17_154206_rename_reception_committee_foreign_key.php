<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameReceptionCommitteeForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reception_committees', function (Blueprint $table) {
            $table->renameColumn('university_id', 'institution_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('reception_committee', function (Blueprint $table) {
        //     $table->renameColumn('institution_id', 'university_id');
        // });
    }
}
