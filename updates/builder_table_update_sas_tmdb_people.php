<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeople extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->string('biography');
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->dropColumn('biography');
        });
    }
}
