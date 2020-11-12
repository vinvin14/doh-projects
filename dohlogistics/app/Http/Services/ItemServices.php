<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 17/09/2020
 * Time: 9:25 AM
 */

namespace App\Http\Services;


use Illuminate\Support\Facades\DB;

class ItemServices
{
    public function all()
    {
        $all = DB::table('libraryitem')
                        ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                        ->orderBy('libraryitem.firstCategory', 'ASC')
                        ->select('libraryitem.*', 'librarybranch.branch as branch')
                        ->paginate(50);
        if(empty($all))
        {
            return 'No Record(s) Found!';
        }
        return $all;
    }
    public function byBranch($branch)
    {
        $items = DB::table('libraryitem')
                        ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                        ->where('libraryitem.branch', $branch)
                        ->orderBy('firstCategory', 'ASC')
                        ->select('libraryitem.*', 'librarybranch.branch as branch')
                        ->paginate(50);
        if(empty($items))
        {
            return 'No Record(s) Found!';
        }
        return $items;
    }
    public function dbm()
    {
        $all = DB::table('librarydbm')
                    ->orderBy('item', 'ASC')
                    ->paginate(50);
        if(empty($all))
        {
            return 'No Record(s) Found!';
        }
        return $all;
    }
}
