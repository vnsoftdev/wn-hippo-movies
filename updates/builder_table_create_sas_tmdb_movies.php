<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSasTmdbMovies extends Migration
{
    public function up()
    {
        Schema::create('sas_tmdb_movies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('tmdb_id')->unsigned();
            $table->text('overview');
            $table->date('release_date');
            $table->integer('runtime');
            $table->double('vote_average', 10, 0);
            $table->integer('vote_count')->unsigned();
            $table->string('poster_path', 255);
            $table->string('backdrop_path', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sas_tmdb_movies');
    }
}
