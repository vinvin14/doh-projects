<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 20/07/2020
 * Time: 11:49 AM
 */

namespace App\Http\Controllers;

use App\Http\Model\LibUnit;
use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;
class LibraryUnitController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->error = $error;
        $this->request = $request;
    }

    public function all()
    {
        $all = LibUnit::all();
        if(empty($all->toArray()))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function route($id)
    {
        $unit = LibUnit::find($id);
        if(empty($unit))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($unit, 200);
    }
    public function create()
    {
        $duplicate = LibUnit::where('Unit', $this->request->input('unit'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Unit has been added before!', 401);
        }
        try
        {
            LibUnit::create($this->request->post());
            return response()->json('Unit Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'UNITADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $group = LibUnit::find($id);
        if(empty($group))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $group->update($this->request->post());
            return response()->json('Unit Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'UNITUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $unit = LibUnit::find($id);
        if(empty($unit))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
