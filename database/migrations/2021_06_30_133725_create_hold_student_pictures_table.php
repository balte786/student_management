<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldStudentPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_student_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('file_name')->nullable();
            $table->timestamps();
            $table->foreign('student_id')
                ->references('id')
                ->on('hold_students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hold_student_pictures');
    }
}
