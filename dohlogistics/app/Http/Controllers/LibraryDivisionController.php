<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 1:01 PM
 */

namespace App\Http\Controllers;

use App\Services\ErrorLoggingServices;
use App\Http\Model\LibDivision;
class LibraryDivisionController extends Controller
{
    private $error;
    public function __construct()
    {
        $this->error = new ErrorLoggingServices();
    }

    public function all()
    {
        $all = LibDivision::all();
        if(empty($all))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function category($id)
    {
        $division = LibDivision::find($id);
        if(empty($division))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($division, 200);
    }
    public function create($request)
    {
        $duplicate = LibDivision::where('division', $request['branch'])->first();
        if(! empty($duplicate))
        {
            return response()->json('This Division has been added before!', 401);
        }
        try
        {
            LibDivision::create($request);
            return response()->json('Division Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'CATADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id, $data)
    {
        $group = LibDivision::find($id);
        if(empty($group))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $group->update($data);
            return response()->json('Division Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'CATUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $division = LibDivision::find($id);
        if(empty($division))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
