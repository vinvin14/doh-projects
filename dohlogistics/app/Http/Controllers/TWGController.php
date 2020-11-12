<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 27/10/2020
 * Time: 11:03 AM
 */

namespace App\Http\Controllers;


use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TWGController extends Controller
{
    public function updateTWG(Request $request, $id, ErrorLogServices $error)
    {
        $api = new APIController($request, $error);
        $item = DB::table('librarytwg')->where('id', $id);
        if(empty($item->first()))
        {
            return response()->json('Item not found!', 404);
        }
        DB::beginTransaction();
        try
        {
            $item->update($request->post());
            $api->createWFPRef();
            DB::commit();
            return response()->json('TWG has been updated!', 200);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $error->init([
                'module' => 'TWGUPDATE',
                'user' => 'outside',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Oops something went wrong! Please contact your admin', 501);
        }
    }
}
