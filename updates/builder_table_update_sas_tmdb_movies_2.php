<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbMovies2 extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_movies', function($table)
        {
            $table->date('release_date')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_movies', function($table)
        {
            $table->date('release_date')->nullable(false)->change();
        });
    }
}
