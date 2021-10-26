<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSasTmdbGenreMovie extends Migration
{
    public function up()
    {
        Schema::create('sas_tmdb_genre_movie', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('movie_id');
            $table->integer('genre_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sas_tmdb_genre_movie');
    }
}
