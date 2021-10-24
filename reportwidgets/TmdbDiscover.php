<?php

namespace Sas\Tmdb\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use GuzzleHttp\Client;

class TmdbDiscover extends ReportWidgetBase
{
    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'Widget title',
                'default'           => 'Movies',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'The Widget Title is required.'
            ],
            'mode' => [
                'title'             => 'Category',
                'type'              => 'dropdown',
                'options'           => [
                    'by_popularity'        => 'Phim hay',
                    'by_popularity_child'  => 'Phim hay cho trẻ em',
                    'vote_average'         => 'Phim đánh giá cao',
                    'primary_release_year' => 'Phim hay trong năm 2021'

                ],
            ],
            'limit' => [
                'title'             => 'Số phim hiển thị',
                'default'           => '10',
                'type'              => 'string',
                'validationPattern' => '^[0-9]*$',
                'validationMessage' => 'Số phim hiển thị phải là số.'

            ]
        ];
    }
    public function render()
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.themoviedb.org/3/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $mode  = $this->property('mode');
        $title  = $this->property('title');
        $limit = $this->property('limit');
        $this->vars['title'] = $title;

        // calc page
        $pageCount = floor($limit / 20) + 1;


        if (!empty($mode)) {
            $params = [];
            if ($mode === 'by_popularity') {
                $params = [
                    'sort_by' => 'popularity.desc'
                ];
            } else if ($mode === 'by_popularity_child') {
                $params = [
                    'certification_country' => 'US',
                    'certification.lte' => 'G',
                    'sort_by' => 'popularity.desc'
                ];
            } else if ($mode === 'vote_average') {
                $params = [
                    'certification_country' => 'US',
                    'certification.lte' => 'R',
                    'sort_by' => 'vote_average.desc'
                ];
            } else if ($mode === 'primary_release_year') {
                $params = [
                    'primary_release_year' => '2021',
                    'sort_by' => 'vote_average.desc'
                ];
            }

            $movies = [];
            for ($page = 1; $page <= $pageCount; $page++) {
                $response = $client->request('GET', 'discover/movie', [
                    'query' => [
                        'api_key' => '4dbbca06792a6ea04fb494a15afffcb8',
                        'page' => $page,
                    ] + $params,
                ]);
                $code = $response->getStatusCode();
                if ($code == 200) {
                    $body = $response->getBody();
                    $moviesPagination = json_decode($body);
                    $movies = array_merge($movies , $moviesPagination->results);
                }
            }
            $this->vars['movies'] = array_slice($movies,0, $limit);

        }

        return $this->makePartial('widget');
    }
    public function onDetails()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.themoviedb.org/3/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $params = \Input::all();
        $id = $params['id'];
        if(!empty($id)){

            $response = $client->request('GET', 'movie/'.$id, [
                'query' => [
                    'api_key' => '4dbbca06792a6ea04fb494a15afffcb8',
                ],
            ]);

            $code = $response->getStatusCode();
            if ($code == 200) {
                $body = $response->getBody();
                $movie = json_decode($body);
                $this->vars['movie'] = $movie;
            }
        }

        return $this->makePartial('details');


    }

    public function init()
    {

        $this->addCss("/plugins/sas/tmdb/assets/css/style.css");
        $this->addCss("/plugins/sas/tmdb/assets/css/lib.css");
        $this->addCss("/plugins/sas/tmdb/assets/css/medium.css");
    }
}
