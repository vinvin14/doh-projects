<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 14/07/2020
 * Time: 9:46 AM
 */

namespace App\Http\Controllers\frontend;


use App\Http\Services\ConfigurationServices;
use App\Http\Services\DisplayServices;

class PageController
{
    private $view, $config;
    public function __construct(DisplayServices $view, ConfigurationServices $config)
    {
        $this->view = $view;
        $this->config['sidebar'] = $config->initConfig();
    }

    public function index()
    {
        $this->config['title'] = 'Dashboard';
        $this->config['selected'] = 'dashboard';
        return $this->view->display('interface', '/pages/index', @$data, $this->config);
    }

}
