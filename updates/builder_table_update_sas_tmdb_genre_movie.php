<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbGenreMovie extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_genre_movie', function($table)
        {
            $table->integer('movie_id')->unsigned()->change();
            $table->integer('genre_id')->unsigned()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_genre_movie', function($table)
        {
            $table->integer('movie_id')->unsigned(false)->change();
            $table->integer('genre_id')->unsigned(false)->change();
        });
    }
}
