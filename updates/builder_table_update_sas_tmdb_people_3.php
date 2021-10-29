<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeople3 extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->string('place_of_birth');
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->dropColumn('place_of_birth');
        });
    }
}
