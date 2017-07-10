<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CollegeQualification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_qualification', function (Blueprint $table) {
            $table->integer('college_id')->unsigned();
            $table->integer('qualification_id')->unsigned();
            $table->integer('study_price')->nullable();
            $table->string('study_period')->nullable();
            $table->string('form');

            $table->primary(['college_id', 'qualification_id', 'form']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('college_qualification');
    }
}
