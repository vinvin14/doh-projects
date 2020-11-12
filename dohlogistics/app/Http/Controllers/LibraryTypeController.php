<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 24/09/2020
 * Time: 2:54 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class LibraryTypeController
{
    private $request, $error;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function all()
    {
        $all =  DB::table('librarytype')
                        ->get()
                        ->toArray();
        if(empty($all))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function type($id)
    {
        $type = DB::table('librarytype')
                        ->where('id', $id)
                        ->first();
        if(empty($type))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($type, 200);
    }
    public function create()
    {
        $duplicate = DB::table('librarytype')
                            ->where('type', $this->request->input('type'))
                            ->first();
        if(! empty($duplicate))
        {
            return response()->json('This Type has been added before!', 401);
        }
        try
        {
            DB::table('librarytype')->insert($this->request->post());
            return response()->json('Type Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'TYPADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
//    public function update($id)
//    {
//        $branch = LibBranch::find($id);
//        if(empty($branch))
//        {
//            return response()->json('No Record(s) Found!');
//        }
//        try
//        {
//            $branch->update($this->request->post());
//            return response()->json('Branch Successfully Updated!');
//        }
//        catch (Exception $exception)
//        {
//            $this->error->create([
//                'user' => $_SESSION['user'],
//                'module' => 'BRNUPDATE',
//                'details' => $exception->getMessage()
//            ]);
//            return response()->json('Something went wrong! Please contact your Administrator!', 501);
//        }
//    }
//    public function destroy($id)
//    {
//        $branch = LibBranch::find($id);
//        if(empty($branch))
//        {
//            return response()->json('No Record(s) Found!', 404);
//        }
//
//    }
}
