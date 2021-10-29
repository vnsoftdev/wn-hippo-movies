<?php

namespace Sas\Tmdb\Models;

use Model;

/**
 * Model
 */
class Movie extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'sas_tmdb_movies';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    protected $fillable = [
        'id',
        'title',
        'tmdb_id',
        'overview',
        'release_date',
        'runtime',
        'vote_average',
        'vote_count',
        'poster_path',
        'backdrop_path'
    ];

    public $belongsToMany = [
        'genres' => [
            \Sas\Tmdb\Models\Genre::class,
            'table'    => 'sas_tmdb_genre_movie',
            'key'      => 'movie_id',
            'otherKey' => 'genre_id'
        ],
        'people' => [
            \Sas\Tmdb\Models\Person::class,
            'table'    => 'sas_tmdb_people_movie_know_for',
            'key'      => 'movie_id',
            'otherKey' => 'person_id'
        ]
    ];
}
