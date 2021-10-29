<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSasTmdbPeople extends Migration
{
    public function up()
    {
        Schema::create('sas_tmdb_people', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('tmdb_id');
            $table->string('profile_path');
            $table->string('name');
            $table->integer('popularity');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sas_tmdb_people');
    }
}
