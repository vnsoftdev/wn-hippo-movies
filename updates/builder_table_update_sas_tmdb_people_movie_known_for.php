<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeopleMovieKnownFor extends Migration
{
    public function up()
    {
        Schema::rename('sas_tmdb_people_movie_know_for', 'sas_tmdb_people_movie_known_for');
    }
    
    public function down()
    {
        Schema::rename('sas_tmdb_people_movie_known_for', 'sas_tmdb_people_movie_know_for');
    }
}
