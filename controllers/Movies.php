<?php namespace Sas\Tmdb\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use GuzzleHttp\Client;

class Movies extends Controller
{
    public $implement = [    ];
    private $client;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Sas.Tmdb', 'sas.tmdb.main.menu', 'sas.tmdb.menu.movies');

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.themoviedb.org/3/',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        $this->addCss("/plugins/sas/tmdb/assets/css/style.css");
        $this->addCss("/plugins/sas/tmdb/assets/css/lib.css");
        $this->addCss("/plugins/sas/tmdb/assets/css/medium.css");
    }
    public function details($id)
    {
        if(!empty($id)){

            $response = $this->client->request('GET', 'movie/'.$id, [
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

    }

    public function index()
    {
        $params = \Input::all();
        if(!empty($params['search'])){
            $search = $params['search'];
            $page = $params['page']?? 1;
            $this->vars['search'] = $search;

            $response = $this->client->request('GET', 'search/movie', [
                'query' => [
                    'api_key' => '4dbbca06792a6ea04fb494a15afffcb8',
                    'query' => $search,
                    'page'=>$page,
                ],
            ]);

            $code = $response->getStatusCode();
            if ($code == 200) {
                $body = $response->getBody();
                $moviesPagination = json_decode($body);
                $this->vars['moviesPagination'] = $moviesPagination;
            }
        }
    }
}
