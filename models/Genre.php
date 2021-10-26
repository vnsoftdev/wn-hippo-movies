<?php namespace Sas\Tmdb\Models;

use Model;

/**
 * Model
 */
class Genre extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'sas_tmdb_genres';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    protected $fillable = ['id',
                            'name',
                            'tmdb_id',
                        ];

    public $belongsToMany = [
        'movies' => [
            \Sas\Tmdb\Models\Movie::class,
            'table'    => 'sas_tmdb_genre_movie',
            'key'      => 'genre_id',
            'otherKey' => 'movie_id'
        ]
    ];

}
