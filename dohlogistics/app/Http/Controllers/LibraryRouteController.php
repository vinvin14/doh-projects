<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 1:05 PM
 */

namespace App\Http\Controllers;

use App\Http\Services\ErrorLogServices;
use App\Http\Model\LibRoute;
use Illuminate\Http\Request;

class LibraryRouteController
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->error = $error;
        $this->request = $request;
    }

    public function all()
    {
        $all = LibRoute::orderBy('route')->get()->toArray();
        if(empty($all))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function route($id)
    {
        $route = LibRoute::find($id);
        if(empty($route))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($route, 200);
    }
    public function create()
    {
        $duplicate = LibRoute::where('route', $this->request->input('route'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Route has been added before!', 401);
        }
        try
        {
            LibRoute::create($this->request->post());
            return response()->json('Route Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'ROUTEADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $group = LibRoute::find($id);
        if(empty($group))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $group->update($this->request->post());
            return response()->json('Route Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'ROUTEUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $route = LibRoute::find($id);
        if(empty($route))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
