<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUploadingStatusToIndexManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('index_managements', function (Blueprint $table) {
            $table->enum('uploading_status', [0,1])->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('index_managements', function (Blueprint $table) {
            $table->enum('uploading_status', [0,1])->default('0');
        });
    }
}
