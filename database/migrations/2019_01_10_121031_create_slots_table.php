<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->timestamp('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('end_date')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->string('place');
          $table->string('progtype');
          $table->string('userid');
          $table->string('creatorid');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
