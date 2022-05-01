<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PlansConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_conferences', function (Blueprint $table) {
            $table->integer('plan_id')->unsigned();
            $table->integer('conference_id')->unsigned();
            $table->primary(['plan_id', 'conference_id']);
            $table->foreign('plan_id')->references('id')->on('plans')->onUpdate('restrict')->onDelete('cascade');            
            $table->foreign('conference_id')->references('id')->on('conferences')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans_conferences');
    }
}
