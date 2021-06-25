<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id')->nullable();
            $table->string('last_name')->nullable();
            $table->double('phone_number')->after('email')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->enum('status', [0,1,2]);
            $table->boolean('admin')->default(false);
            $table->timestamp('approved_at')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('school_categories')
                ->onDelete('cascade');

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
