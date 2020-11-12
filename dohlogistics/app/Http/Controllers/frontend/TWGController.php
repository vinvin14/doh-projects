<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 06/10/2020
 * Time: 10:14 AM
 */

namespace App\Http\Controllers\frontend;

use App\Http\Services\DisplayServices;
use App\Http\Services\ConfigurationServices;
use App\Http\Services\TWGServices;

class TWGController
{
    private $display, $config;
    public function __construct(DisplayServices $display, ConfigurationServices $config)
    {
        $this->display = $display;
        $this->config = $config;
    }
    public function index()
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/members'
        ];
        $data['subPageSelected'] =  'twg';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }
    public function members()
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/members',
        ];
//        $data['equipments'] = $inventory->getEquipments();
        $data['subPageSelected'] = 'members';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }
    public function updateTWG($id)
    {

    }
    public function wfp(TWGServices $twg)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/wfp/index',
        ];
        $data['wfp'] = $twg->wfp();
        $data['subPageSelected'] = 'wfp';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }

    public function wfpShow($id, TWGServices $wfp)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/wfp/show',
        ];
        $data['wfp'] = $wfp->wfpShow($id);
        $data['subPageSelected'] = 'wfp';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }
    public function wfpUpdate($id, TWGServices $wfp)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/wfp/show',
        ];
        $data['wfp'] = $wfp->wfpShow($id);
        $data['subPageSelected'] = 'wfp';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }
    public function requestsApproved(TWGServices $twg)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/requests',
            'subPage2' => 'twg/requestApproved'
        ];
        $data['twg'] = $twg->allByStatus('approved');
        $data['subPageSelected'] =  'requests';
        $data['subPage2Selected'] =  'requestApproved';
        return $this->display->display('interfaceWSubPageNSubPage2', 'twg/index', @$data, $config);
    }
    public function requestsPending(TWGServices $twg)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/requests',
            'subPage2' => 'twg/requestPending'
        ];
        $data['twg'] = $twg->allByStatus('pending');
        $data['subPageSelected'] =  'requests';
        $data['subPage2Selected'] =  'requestPending';
        return $this->display->display('interfaceWSubPageNSubPage2', 'twg/index', @$data, $config);
    }
    public function requestsDeclined(TWGServices $twg)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/requests',
            'subPage2' => 'twg/requestDeclined'
        ];
        $data['twg'] = $twg->allByStatus('denied');
        $data['subPageSelected'] =  'requests';
        $data['subPage2Selected'] =  'requestDeclined';
        return $this->display->display('interfaceWSubPageNSubPage2', 'twg/index', @$data, $config);
    }
    public function twgDelete($id, TWGServices $twg)
    {
        $config = [
            'title' => 'TWG',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'twg',
            'subPage' => 'twg/wfp/index',
        ];
        $twg->wfpDelete($id);
        $data['wfp'] = $twg->wfp();
        $data['subPageSelected'] = 'wfp';
        return $this->display->display('interfaceWSubPage', 'twg/index', @$data, $config);
    }
}
