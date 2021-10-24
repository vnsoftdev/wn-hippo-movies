<?php namespace Sas\Tmdb;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
    public function registerReportWidgets()
{
    return [
        'Sas\Tmdb\ReportWidgets\TmdbDiscover' => [
            'label'   => 'Tmdb Discover',
            'context' => 'dashboard',
        ],

    ];
}
}
