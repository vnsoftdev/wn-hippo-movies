<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeople4 extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->string('profile_path', 255)->nullable()->change();
            $table->date('birthday')->nullable()->change();
            $table->string('place_of_birth', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->string('profile_path', 255)->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('place_of_birth', 255)->nullable(false)->change();
        });
    }
}
