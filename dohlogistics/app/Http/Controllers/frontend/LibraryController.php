<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 1:23 PM
 */

namespace App\Http\Controllers\frontend;


use App\Http\Controllers\LibraryUnitController;
use App\Http\Model\LibUnit;
use App\Http\Services\BranchServices;
use App\Http\Services\ConfigurationServices;
use App\Http\Services\DisplayServices;
use App\Http\Services\ItemServices;
use App\Services\ErrorLoggingServices;
use Illuminate\Support\Facades\DB;
use App\Http\Model\LibBranch;

class LibraryController
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
            'title' => 'Library',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];
        return $this->display->display('interface', 'library/index', @$data, $config);
    }
    public function items(ItemServices $item, BranchServices $branch)
    {
        $config = [
            'title' => 'Library Items',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];
        $data['items'] = $item->all();
        $data['branches'] = $branch->all();
        $data['branchSelected'] = 'allitems';
        return $this->display->display('interface', 'library/item/index', @$data, $config);
    }
    public function itemsByBranch($branch, ItemServices $item, BranchServices $branchServices)
    {
        $config = [
            'title' => 'Library',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];
        $data['branches'] = $branchServices->all();
        switch ($branch)
        {
            case 'dbm':
                $data['branchSelected'] = 'dbm';
                $data['items'] = $item->dbm();
                return $this->display->display('interface', 'library/item/dbm', @$data, $config);
                break;
            case 'Information-Technology':
                $data['branchSelected'] = 'Information-Technology';
                $data['items'] = $item->byBranch(7);
                return $this->display->display('interface', 'library/item/it', @$data, $config);
                break;
            case 'Infrastructure':
                $data['branchSelected'] = 'Infrastructure';
                $data['items'] = $item->byBranch(6);
                return $this->display->display('interface', 'library/item/infrastructure', @$data, $config);
                break;
            case 'Medical':
                $data['branchSelected'] = 'Medical';
                $data['items'] = $item->byBranch(4);
                return $this->display->display('interface', 'library/item/medical', @$data, $config);
                break;
            case 'Non-Medical':
                $data['branchSelected'] = 'Non-Medical';
                $data['items'] = $item->byBranch(5);
                return $this->display->display('interface', 'library/item/medical', @$data, $config);
                break;
        }
    }
    public function item($id)
    {
        $config = [
            'title' => 'Library Items',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];
        $data['item'] = DB::table('libraryitem')
                            ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                            ->select('libraryitem.*', 'librarybranch.branch as branch', 'librarybranch.id as branchID')
                            ->where('libraryitem.id', '=', $id)
                            ->first();
        $data['branch'] = LibBranch::all();
        return $this->display->display('interface', 'library/item/show', @$data, $config);
    }
    public function branch()
    {
        $config = [
            'title' => 'Library Branch',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/branch/index', @$data, $config);
    }
    public function units()
    {
        $config = [
            'title' => 'Library Unit',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/unit/index', @$data, $config);
    }
    public function categories()
    {
        $config = [
            'title' => 'Library Category',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/category/index', @$data, $config);
    }
    public function drugsAndMeds()
    {
        $config = [
            'title' => 'Library Drugs and Meds',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/drugsAndMeds/index', @$data, $config);
    }
    public function DM()
    {
        $config = [
            'title' => 'Library Drugs and Meds',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/drugsAndMeds/dm', @$data, $config);
    }
    public function dmShow($id)
    {
        $config = [
            'title' => 'Library Drugs and Meds',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];
        $data['dm'] = DB::table('librarydm')
                            ->join('libraryroute', 'librarydm.route', '=', 'libraryroute.id')
                            ->join('libraryform', 'librarydm.form', '=', 'libraryform.id')
                            ->select('librarydm.*', 'libraryroute.route as route', 'libraryroute.id as routeID', 'libraryform.form as form', 'libraryform.id as formID')
                            ->where('librarydm.id', '=', $id)
                            ->first();
        return $this->display->display('interface', 'library/drugsAndMeds/show', @$data, $config);
    }
    public function routes()
    {
        $config = [
            'title' => 'Library Routes',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/drugsAndMeds/routes', @$data, $config);
    }
    public function forms()
    {
        $config = [
            'title' => 'Library Forms',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/drugsAndMeds/forms', @$data, $config);
    }
    public function programs()
    {
        $config = [
            'title' => 'Library Programs',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'library'
        ];

        return $this->display->display('interface', 'library/programs/index', @$data, $config);
    }
}
