<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 30/07/2020
 * Time: 9:55 AM
 */

namespace App\Http\Controllers\frontend;

use App\Http\Services\DisplayServices;
use App\Http\Services\ConfigurationServices;
use App\Http\Services\InventoryServices;
use Illuminate\Support\Facades\DB;

class InventoryController
{
    private $display, $config;
    public function __construct(DisplayServices $display, ConfigurationServices $config)
    {
        $this->display = $display;
        $this->config = $config;
    }

    public function equipments(InventoryServices $inventory)
    {
        $config = [
            'title' => 'Inventory Equipments',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'inventory',
            'subPage' => 'inventory/equipment'
        ];
        $data['equipments'] = $inventory->getEquipments();
        $data['subPageSelected'] =  'equipments';
        return $this->display->display('interfaceWSubPage', 'inventory/index', @$data, $config);
    }
    public function supplies(InventoryServices $inventory)
    {
        $config = [
            'title' => 'Inventory Supplies',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'inventory',
            'subPage' => 'inventory/supplies'
        ];
        $data['supplies'] = $inventory->getSupplies();
        $data['subPageSelected'] =  'supplies';
        return $this->display->display('interfaceWSubPage', 'inventory/index', @$data, $config);
    }
    public function drugsAndMeds()
    {
        $config = [
            'title' => 'Inventory Drugs and Medicines',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'inventory',
            'subPage' => 'inventory/drugsAndMeds'
        ];
        $data['subPageSelected'] =  'drugsAndMeds';
        return $this->display->display('interfaceWSubPage', 'inventory/index', @$data, $config);
    }
    public function details($origin, $id)
    {
        $config = [
            'title' => 'Inventory Equipments',
            'sidebar' => $this->config->initConfig($_SESSION['role']),
            'selected' => 'inventory',
            'subPage' => 'inventory/details'
        ];

        switch ($origin)
        {
            case 1:
                $data['inventory'] = DB::table('equipment')->where('id', $id)->first();
                break;
            case 2:
                $data['inventory'] = DB::table('supplies')->where('id', $id)->first();
                break;

            case 3:
                $data['inventory'] = DB::table('dm')->where('id', $id)->first();
                break;
        }

//        $data['subPageSelected'] =  'drugsAndMeds';
        if($origin == 3)
        {
            $data['motherItem'] = DB::table('librarydm')->where('id', $data['inventory']->libItem)->first();
        }
        else
        {
            $data['motherItem'] = DB::table('libraryitem')->where('id', $data['inventory']->libItem)->first();
        }
       if($data['inventory']->stockOrPn == 'sn')
       {
           $data['stocks'] = DB::table('stockcard')
               ->join('libraryunit', 'stockcard.unit', '=', 'libraryunit.id')
               ->select('stockcard.*', 'libraryunit.unit as unit')
               ->where('motherItem', $id)
               ->get();
       }
       else
       {
           $data['stocks'] = DB::table('propertycard')
//               ->join('libraryunit', 'propertycard.unit', '=', 'libraryunit.id')
//               ->select('propertycard.*', 'libraryunit.unit as unit')
               ->where('motherItem', $id)
               ->get();
       }
       $totalValue = [];
       foreach ($data['stocks'] as $stocks)
       {
           $value = intval($stocks->unitCost)*intval($stocks->quantity);
            array_push($totalValue, $value);
       }
       $data['inventory']->totalValue = array_sum($totalValue);
       return $this->display->display('interfaceWSubPage', 'inventory/details', @$data, $config);
    }
}
