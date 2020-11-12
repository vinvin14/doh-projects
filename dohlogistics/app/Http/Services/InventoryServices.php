<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 21/09/2020
 * Time: 10:39 AM
 */

namespace App\Http\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryServices
{
    private $error;
    public function __construct(ErrorLogServices $error)
    {
        $this->error = $error;
    }
    public function getEquipments()
    {
        $query = DB::table('inventory')
                        ->join('libraryitem', 'inventory.item', '=', 'libraryitem.id' )
                        ->join('libraryunit', 'inventory.unit', '=', 'libarayunit.id')
                        ->select('inventory.*', 'libraryitem.firstCategory as firstCategory', 'libraryitem.secondCategory as secondCategory', 'libraryunit.unit as unit')
                        ->where('inventoryType','equipment')
                        ->groupBy('inventory.item')
                        ->paginate(100);

        if(empty($query))
        {
            return 'No Record(s) Found!';
        }
        return $query;
    }
    public function getSupplies()
    {
        $query = DB::table('inventory')
                        ->join('libraryitem', 'inventory.item', '=', 'libraryitem.id' )
                        ->join('libraryunit', 'inventory.unit', '=', 'libarayunit.id')
                        ->select('inventory.*', 'libraryitem.firstCategory as firstCategory', 'libraryitem.secondCategory as secondCategory', 'libraryunit.unit as unit')
                        ->where('inventoryType','supplies')
                        ->groupBy('inventory.item')
                        ->paginate(100);

        if(empty($query))
        {
            return 'No Record(s) Found!';
        }
        return $query;
    }
    public function getDM()
    {
        $query = DB::table('inventory')
                        ->join('libraryitem', 'inventory.item', '=', 'libraryitem.id' )
                        ->join('libraryunit', 'inventory.unit', '=', 'libarayunit.id')
                        ->select('inventory.*', 'libraryitem.firstCategory as firstCategory', 'libraryitem.secondCategory as secondCategory', 'libraryunit.unit as unit')
                        ->where('drugsAndMeds','supplies')
                        ->groupBy('inventory.item')
                        ->paginate(100);

        if(empty($query))
        {
            return 'No Record(s) Found!';
        }
        return $query;
    }
    public function show($id)
    {
        $query = DB::table('inventory')
                        ->where('id', $id)
                        ->first();
        if(empty($query))
        {
            return 'No Record(s) Found!';
        }
        return $query;
    }
    public function create($input)
    {
        $duplicate = DB::table('inventory')
                            ->where([
                                'item' => $input['item'],
                                'IAR' => $input['IAR'],
                                'dateReceived' => $input['dateReceived']
                            ])
                            ->first();
        if(! empty($duplicate))
        {
            return 'Warning! This inventory entry has been added before!';
        }
        DB::beginTransaction();
        try
        {
            DB::table('inventory')
                    ->insert($input);
            DB::commit();
            return 'Inventory Entry has been successfully recorded!';
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
               'user' => $_SESSION['user'],
               'details' => $exception->getMessage(),
               'module' => 'INVENADD'
            ]);
            return 'Oops Something went wrong! Please Contact your Administrator!';
        }
    }
    public function update($id, $input)
    {
        $query = DB::table('inventory')
            ->where('id', $id);

        if (!empty($query->first())) {
            return 'No Record(s) Found!';
        }
        DB::beginTransaction();
        try
        {
            $query->update($input);
            DB::commit();
            return 'Inventory Record has been successfully Updated!';
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'details' => $exception->getMessage(),
                'module' => 'INVENADD'
            ]);
            return 'Oops Something went wrong! Please Contact your Administrator!';
        }
    }
    public function destroy($id)
    {
        $query = DB::table('inventory')
                        ->where('id', $id)
                        ->first();
        if(empty($query))
        {
            return 'No Record(s) Found!';
        }
        DB::table('inventory')->delete($id);
        return 'Successfully Deleted!';
    }
//    public function getEquipments()
//    {
//        $result = DB::table('equipment')
//            ->join('libraryitem', 'equipment.libItem', '=', 'libraryitem.id')
//            ->join('librarycategory', 'equipment.category', '=', 'librarycategory.id')
//            ->select('equipment.*', 'equipment.id as eqid', 'libraryitem.*', 'libraryitem.id as libid', 'librarycategory.category as category')
//            ->distinct()
//            ->paginate(50);
//        if(empty($result))
//        {
//            return 'No Record(s) Found!';
//        }
//        return $result;
//    }
//    public function getSupplies()
//    {
//        $result = DB::table('supplies')
//            ->join('libraryitem', 'supplies.libItem', '=', 'libraryitem.id')
//            ->join('librarycategory', 'supplies.category', '=', 'librarycategory.id')
//            ->select('supplies.*', 'supplies.id as supid', 'libraryitem.*', 'libraryitem.id as libid', 'librarycategory.category as category')
//            ->distinct()
//            ->paginate(50);
//        if(empty($result))
//        {
//            return 'No Record(s) Found!';
//        }
//        return $result;
//    }
//    public function getDrugsAndMeds()
//    {
//        $result = DB::table('dm')
//            ->join('librarydm', 'dm.libItem', '=', 'librarydm.id')
//            ->select('dm.*', 'dm.id as eqid', 'librarydm.*', 'librarydm.id as libid')
//            ->distinct()
//            ->paginate(50);
//        if(empty($result))
//        {
//            return 'No Record(s) Found!';
//        }
//        return $result;
//    }
}
