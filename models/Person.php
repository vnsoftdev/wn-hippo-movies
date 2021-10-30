<?php namespace Sas\Tmdb\Models;

use Model;

/**
 * Model
 */
class Person extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'sas_tmdb_people';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    protected $fillable = [
        'id',
        'name',
        'tmdb_id'             ,
        'biography'           ,
        'known_for_department',
        'gender'              ,
        'popularity'          ,
        'profile_path'        ,
        'place_of_birth'      ,
    ];

    public $belongsToMany = [
        'known_for' => [
            \Sas\Tmdb\Models\Movie::class,
            'table'    => 'sas_tmdb_people_movie_known_for',
            'key'      => 'movie_id',
            'otherKey' => 'person_id'
        ]
    ];
}
