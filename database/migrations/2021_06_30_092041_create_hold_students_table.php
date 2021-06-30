<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->integer('quota_id')->unsigned();
            $table->integer('index_id')->unsigned();
            $table->enum('status', [0,1]);
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->longText('home_address')->nullable();
            $table->string('name_of_nok')->nullable();
            $table->string('address_of_nok')->nullable();
            $table->string('name_of_parent')->nullable();
            $table->longText('address_of_parent')->nullable();
            $table->date('date_admitted')->nullable();
            $table->string('admission_number')->nullable();
            $table->string('qualification_one')->nullable();
            $table->date('qualification_one_date')->nullable();

            $table->string('qualification_two')->nullable();
            $table->date('qualification_two_date')->nullable();

            $table->string('qualification_three')->nullable();
            $table->date('qualification_three_date')->nullable();

            $table->string('qualification_four')->nullable();
            $table->date('qualification_four_date')->nullable();

            $table->string('qualification_five')->nullable();
            $table->date('qualification_five_date')->nullable();



            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('cascade');

            $table->foreign('quota_id')
                ->references('id')
                ->on('school_quotas')
                ->onDelete('cascade');

            $table->foreign('index_id')
                ->references('id')
                ->on('index_managements')
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
        Schema::dropIfExists('hold_students');
    }
}
