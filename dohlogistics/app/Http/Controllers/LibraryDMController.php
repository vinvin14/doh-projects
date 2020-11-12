<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 27/07/2020
 * Time: 1:03 PM
 */

namespace App\Http\Controllers;

use App\Http\Model\LibDM;
use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryDMController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }
    public function all()
    {
//        $all = LibDM::orderBy('firstCategory')->get();
        $all = DB::table('librarydm')
                        ->join('libraryroute', 'librarydm.route', '=', 'libraryroute.id')
                        ->join('libraryform', 'librarydm.form', '=', 'libraryform.id')
                        ->select('librarydm.*', 'libraryroute.route as route', 'libraryroute.id as routeID', 'libraryform.form as form', 'libraryform.id as formID')
                        ->orderBy('librarydm.firstCategory')->get();
        if(empty($all->toArray()))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function dm($id)
    {
        $dm = LibDM::find($id);
        if(empty($dm))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($dm, 200);
    }
    public function create()
    {
        $duplicate = LibDM::where([
            'firstCategory' => $this->request->input('firstCategory'),
            'secondCategory' => $this->request->input('secondCategory'),
            'form' => $this->request->input('form'),
        ])->first();
        if(! empty($duplicate))
        {
            return response()->json('This DM record has been added before!', 401);
        }
        try
        {
            LibDM::create($this->request->post());
            return response()->json('DM record Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'DMADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $dm = LibDM::find($id);
        if(empty($dm))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $dm->update($this->request->post());
            return response()->json('dm Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'DMUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $dm = LibDM::find($id);
        if(empty($dm))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
