<?php namespace Sas\Tmdb\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSasTmdbPeople2 extends Migration
{
    public function up()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->date('birthday');
            $table->integer('gender');
            $table->string('known_for_department');
        });
    }
    
    public function down()
    {
        Schema::table('sas_tmdb_people', function($table)
        {
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('known_for_department');
        });
    }
}
