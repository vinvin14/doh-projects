<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 17/09/2020
 * Time: 11:16 AM
 */

namespace App\Http\Services;


use Illuminate\Support\Facades\DB;

class BranchServices
{
    public function all()
    {
        $branches = DB::table('librarybranch')
            ->get()
            ->toArray();
        if(empty($branches))
        {
            return 'No Record(s) Found!';
        }
        return $branches;
    }
}
