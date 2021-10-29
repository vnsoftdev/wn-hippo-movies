<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSasTmdbPeopleMovieKnowFor extends Migration
{
    public function up()
    {
        Schema::create('sas_tmdb_people_movie_know_for', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('movie_id')->unsigned();
            $table->integer('person_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sas_tmdb_people_movie_know_for');
    }
}
