<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KlassesConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klasses_conferences', function (Blueprint $table) {
                   
            $table->integer('klass_id')->unsigned();
            $table->integer('conference_id')->unsigned();
            $table->primary(['klass_id', 'conference_id']);
            $table->foreign('klass_id')->references('id')->on('klasses')->onUpdate('restrict')->onDelete('cascade');            
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
        Schema::dropIfExists('klasses_conferences');
    }
}
