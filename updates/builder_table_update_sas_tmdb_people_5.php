<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeople5 extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->text('biography')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->string('biography', 255)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
