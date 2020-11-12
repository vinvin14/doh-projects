<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 04/08/2020
 * Time: 9:41 AM
 */

namespace App\Http\Controllers;

use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }
    public function inventory($category)
    {
        switch ($category)
        {
            case 'equipments':
                $inventory = DB::table('equipment')
                    ->join('libraryitem', 'equipment.libItem', '=', 'libraryitem.id')
                    ->join('librarycategory', 'equipment.category', '=', 'librarycategory.id')
                    ->select('equipment.*', 'equipment.id as eqid', 'libraryitem.*', 'libraryitem.id as libid', 'librarycategory.category as category')
                    ->distinct()
                    ->get()
                    ->toArray();
                if(empty($inventory))
                {
                    return response()->json('No Record(s) Found!', 404);
                }
                return response()->json($inventory, 200);
                break;

            case 'supplies':
                $inventory = DB::table('supplies')
                    ->join('libraryitem', 'supplies.libItem', '=', 'libraryitem.id')
                    ->join('librarycategory', 'supplies.category', '=', 'librarycategory.id')
                    ->select('supplies.*', 'supplies.id as eqid', 'libraryitem.*', 'libraryitem.id as libid', 'librarycategory.category as category')
                    ->distinct()
                    ->get()
                    ->toArray();
                if(empty($inventory))
                {
                    return response()->json('No Record(s) Found!', 404);
                }
                return response()->json($inventory, 200);
                break;

            case 'drugsAndMeds':
                $inventory = DB::table('dm')
                    ->join('librarydm', 'dm.libItem', '=', 'librarydm.id')
                    ->select('dm.*', 'dm.id as eqid', 'librarydm.*', 'librarydm.id as libid')
                    ->distinct()
                    ->get()
                    ->toArray();
                if(empty($inventory))
                {
                    return response()->json('No Record(s) Found!', 404);
                }
                return response()->json($inventory, 200);
                break;
        }
    }
    public function create()
    {
        DB::beginTransaction();
        switch  ($this->request->input('category'))
        {
            case 6:
                $origin = DB::table('equipment')->where('libItem', $this->request->input('libItem'))->first();
                $table = 'equipment';
                break;
            case 7:
                $origin = DB::table('supplies')->where('libItem', $this->request->input('libItem'))->first();
                $table = 'supplies';
                break;
            case 8:
                $origin = DB::table('dm')->where('libItem', $this->request->input('libItem'))->first();
                $table = 'dm';
                break;
        }
        //get the unit cost
        $unitCost = intval($this->request->input('unitCost'));
        if($unitCost < 15000)
        {
            //check if the item has been created under IAR
            if(! empty(
                DB::table('stockcard')->where([
                    'libItem' => $this->request->input('libItem'),
                    'iarLotNum' => $this->request->input('iarLotNum'),
                ])->first()))
            {
                return response()->json('Error! this entry has been added previously!', 401);
            }

            try
            {
                if(empty($origin))
                {
                    $originID = DB::table($table)->insertGetId([
                        'libItem' => $this->request->input('libItem'),
                        'quantity' => $this->request->input('quantity'),
                        'totalValue' => intval($this->request->input('quantity'))*intval($this->request->input('unitCost')),
                        'category' => $this->request->input('category'),
                        'type' => $this->request->input('type'),
                        'dateAdded' => date('Y-m-d'),
                        'stockOrPn' => 'sn',
                    ]);
                    DB::table('stockcard')->insert([
                        'stockNumber' => $this->request->input('pnStockNumber'),
                        'libItem' => $this->request->input('libItem'),
                        'iarLotNum' => $this->request->input('iarLotNum'),
                        'brand' => $this->request->input('brand'),
                        'category' => $this->request->input('category'),
                        'quantity' => $this->request->input('quantity'),
                        'unit' => $this->request->input('unit'),
                        'unitCost' => $this->request->input('unitCost'),
                        'totalValue' => $this->request->input('totalValue'),
                        'dateReceived' => $this->request->input('dateReceived'),
                        'expiryDate' => $this->request->input('expiryDate'),
                        'motherItem' => $originID,
                        'entryBy' => 'admin'
                    ]);
                }
                else
                {
                    DB::table('stockcard')->insert([
                        'stockNumber' => $this->request->input('pnStockNumber'),
                        'libItem' => $this->request->input('libItem'),
                        'iarLotNum' => $this->request->input('iarLotNum'),
                        'brand' => $this->request->input('brand'),
                        'category' => $this->request->input('category'),
                        'quantity' => $this->request->input('quantity'),
                        'unit' => $this->request->input('unit'),
                        'unitCost' => $this->request->input('unitCost'),
                        'totalValue' => $this->request->input('totalValue'),
                        'dateReceived' => $this->request->input('dateReceived'),
                        'expiryDate' => $this->request->input('expiryDate'),
                        'motherItem' => $origin->id,
//                    'entryBy' => $_SESSION['user']
                        'entryBy' => 'admin'
                    ]);

                    $finalQuantity = (intval($origin->quantity) + (intval($this->request->input('quantity'))));
                    $totalValue = (intval($origin->totalValue) + (intval($this->request->input('totalValue'))));
                    DB::table($table)
                        ->where('id', $origin->id)
                        ->update([
                            'quantity' => $finalQuantity,
                            'totalValue' => $totalValue
                        ]);
                }

                DB::commit();
                return response()->json('Successfully Added!', 200);
            }
            catch (\Exception $exception)
            {
                DB::rollBack();
                $this->error->init([
//                    'user' => $_SESSION['user'],
                    'module' => 'INVENADD',
                    'details' => $exception->getMessage()
                ]);
                return response()->json('Something went wrong!, Please contact your administrator!', 501);
            }
        }
        else
        {
            //propertycard
            if(! empty(
            DB::table('propertycard')->where([
                'libItem' => $this->request->input('libItem'),
                'iarLotNum' => $this->request->input('IAR'),
            ])->first()))
            {
                return response()->json('Error! this entry has been added previously!', 401);
            }

            try
            {
                if(empty($origin))
                {
                    $originID = DB::table($table)->insertGetId([
                        'libItem' => $this->request->input('libItem'),
                        'quantity' => $this->request->input('quantity'),
                        'totalValue' => intval($this->request->input('quantity'))*intval($this->request->input('unitCost')),
                        'category' => $this->request->input('category'),
                        'type' => $this->request->input('type'),
                        'dateAdded' => date('Y-m-d'),
                        'stockOrPn' => 'pn',
                    ]);

                    DB::table('propertycard')->insert([
                        'propertyNumber' => $this->request->input('pnStockNumber'),
                        'libItem' => $this->request->input('libItem'),
                        'iarLotNum' => $this->request->input('iarLotNum'),
                        'brand' => $this->request->input('brand'),
                        'category' => $this->request->input('category'),
                        'quantity' => $this->request->input('quantity'),
                        'unit' => $this->request->input('unit'),
                        'unitCost' => $this->request->input('unitCost'),
                        'dateReceived' => $this->request->input('dateReceived'),
                        'expiryDate' => $this->request->input('expiryDate'),
                        'totalValue' => $this->request->input('totalValue'),
                        'motherItem' => $originID,
//                        'entryBy' => $_SESSION['user'],
                        'entryBy' => 'admin'
                    ]);
                }
                else
                {
                    DB::table('propertycard')->insert([
                        'propertyNumber' => $this->request->input('pnStockNumber'),
                        'libItem' => $this->request->input('libItem'),
                        'iarLotNum' => $this->request->input('iarLotNum'),
                        'brand' => $this->request->input('brand'),
                        'category' => $this->request->input('category'),
                        'quantity' => $this->request->input('quantity'),
                        'unit' => $this->request->input('unit'),
                        'unitCost' => $this->request->input('unitCost'),
                        'dateReceived' => $this->request->input('dateReceived'),
                        'expiryDate' => $this->request->input('expiryDate'),
                        'totalValue' => $this->request->input('totalValue'),
                        'motherItem' => $origin->id,
//                        'entryBy' => $_SESSION['user']
                        'entryBy' => 'admin'
                    ]);
                }
                $finalQuantity = (intval($origin['quantity'])+intval($this->request->input('quantity')));
                $totalValue = (intval($origin['totalValue']) + (intval($this->request->input('totalValue'))));
                DB::table($table)
                    ->where('id', $origin['id'])
                    ->update([
                        'quantity' => $finalQuantity,
                        'totalValue' => $totalValue
                    ]);
                DB::commit();
                return response()->json('Successfully Added!', 200);
            }
            catch (\Exception $exception)
            {
                DB::rollBack();
                $this->error->init([
                    'user' => $_SESSION['user'],
                    'module' => 'INVENADD',
                    'details' => $exception->getMessage()
                ]);
                return response()->json('Something went wrong!, Please contact your administrator!', 501);
            }
        }
    }
    public function getStock($type, $id)
    {
        switch ($type)
        {
            case 'pn':
                $result = DB::table('propertycard')
//                                ->join('propertycard.libraryunit', 'propertycard.unit', '=', 'libraryunit.id')
                                ->where('id', $id)
//                                ->select('propertycard.*', 'unit.unit as unit')
                                ->first();
                break;
            case 'sn':
                $result = DB::table('stockcard')
//                                ->join('libraryunit', 'stockcard.unit', '=', 'libraryunit.id')
                                ->where('stockcard.id', $id)
//                                ->select('stockcard.*', 'libraryunit.unit as unit')
                                ->first();
                break;
        }
        return response()->json($result);
    }
    public function updateStock($type, $id)
    {
        //select item
        switch ($type)
        {
            case 'pn':
                $childQuery = DB::table('propertycard')
                                ->where('id', $id);
                $table = 'propertycard';
                break;
            case 'sn':
                $childQuery = DB::table('stockcard')
                                ->where('id', $id);
                $table = 'stockcard';
                break;
        }
        $childItem = $childQuery->first();
        $motherID = $childItem->motherItem;

        if(empty($childItem))
        {
            return response()->json('No Data Record(s) Found!', 404);
        }
        if($childItem->iarLotNum !== $this->request->input('iarLotNum'))
        {
            if(! empty(DB::table($table)->where('iarLotNum', $this->request->input('iarLotNum'))->first()))
            {
                return response()->json('Error! Entry is already in our database and might cause duplication!', 401);
            }
        }
        if($childItem->quantity !== $this->request->input('quantity'))
        {
            switch ($childItem->category)
            {
                case 6:
                    $motherItem = DB::table('equipmemt')
                                        ->where('id', $motherID)
                                        ->first();
                    $motherTable = 'equipmemt';
                    break;
                case 7:
                    $motherItem = DB::table('supplies')
                                        ->where('id', $motherID)
                                        ->first();
                    $motherTable = 'supplies';

                    break;
                case 8:
                    $motherItem = DB::table('dm')
                                        ->where('id', $motherID)
                                        ->first();
                    $motherTable = 'dm';
                    break;
            }
        }

        DB::beginTransaction();
        try
        {
            $childQuery->update($this->request->post());
            $this->updateTotalVal($motherID, $motherItem->origin, $motherItem->stockOrPn);
            DB::commit();
            return response()->json('Successfully Updated!', 200);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
               'module' => 'STKUPDATE',
               'details' => $exception->getMessage(),
               'user' => $_SESSION['user']
            ]);
            return response()->json('Oops something went wrong! Please contact your administrator!', 501);
        }
    }
    public function updateTotalVal($mother, $origin, $stockOrPn)
    {
        if($stockOrPn == 'pn')
        {
            $children = DB::table('propertycard')
                            ->where('motherItem', $mother)
                            ->get();
        }
        else
        {
            $children = DB::table('stockcard')
                            ->where('motherItem', $mother)
                            ->get();
        }
        //get all child and sum them up
        $totalValue = [];
        foreach ($children as $child)
        {
            array_push($totalValue, $child->totalValue);
        }
        DB::beginTransaction();
        try
        {
            switch ($origin)
            {
                case '1':
                    $mother = DB::table('equipment')
                        ->where('id', $mother)
                        ->update([
                            'totalValue' => array_sum($totalValue)
                        ]);
                    break;
                case '2':
                    $mother = DB::table('supplies')
                        ->where('id', $mother)
                        ->update([
                            'totalValue' => array_sum($totalValue)
                        ]);
                    break;
                case '3':
                    $mother = DB::table('dm')
                        ->where('id', $mother)
                        ->update([
                            'totalValue' => array_sum($totalValue)
                        ]);
                    break;
            }
            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
//                    'user' => $_SESSION['user'],
                'module' => 'UPTVADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
}

