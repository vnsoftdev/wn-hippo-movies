<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbMovies extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_movies', function($table)
        {
            $table->integer('runtime')->nullable()->change();
            $table->string('poster_path', 255)->nullable()->change();
            $table->string('backdrop_path', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_movies', function($table)
        {
            $table->integer('runtime')->nullable(false)->change();
            $table->string('poster_path', 255)->nullable(false)->change();
            $table->string('backdrop_path', 255)->nullable(false)->change();
        });
    }
}
