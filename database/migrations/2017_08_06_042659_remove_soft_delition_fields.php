<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSoftDelitionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('specialties', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('professions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('institutions', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
