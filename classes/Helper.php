<?php namespace Sas\Tmdb\Classes;
use Sas\Tmdb\Models\Genre;
use Sas\Tmdb\Models\Movie;
use GuzzleHttp\Client;

class Helper
{
    public static function viewMovie($tmdb_id)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.themoviedb.org/3/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $tmdb_movie_id = Movie::where('tmdb_id', $tmdb_id)->first();

        if($tmdb_movie_id==null) {
            $response = $client->request('GET', 'movie/'.$tmdb_id, [
                'query' => [
                    'api_key' => '4dbbca06792a6ea04fb494a15afffcb8',
                ],
            ]);

            $code = $response->getStatusCode();
            if ($code == 200) {
                $body = $response->getBody();
                $api_movie = json_decode($body);

                $movie = Movie::create(
                    ['title' => $api_movie->title,
                    'tmdb_id' => $api_movie->id,
                    'overview'=> $api_movie->overview,
                    'release_date'=> $api_movie->release_date,
                    'runtime'=> $api_movie->runtime,
                    'vote_average' => $api_movie->vote_average,
                    'vote_count'=> $api_movie->vote_count,
                    'poster_path'=> $api_movie->poster_path,
                    'backdrop_path'=> $api_movie->backdrop_path,
                    ]
                );
                $movie->save();

                $api_genres = $api_movie->genres;

                foreach($api_genres as $g) {
                    $genres_tmdb_id = Genre::where('tmdb_id', $g->id)->first();
                    if($genres_tmdb_id == null) {
                        $genre = Genre::create(
                            [
                                'tmdb_id'=> $g->id,
                                'name'=> $g->name,
                            ]
                        );
                        $genre->save();
                        $movie->genres()->attach($genre->id);
                    } else {
                        $movie->genres()->attach($genres_tmdb_id->id);
                    }
                }
                $movie->reload();
                return $movie;
            }

        } else {
        return $tmdb_movie_id;
        }

    }
}
