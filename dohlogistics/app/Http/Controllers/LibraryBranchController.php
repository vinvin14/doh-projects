<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 1:27 PM
 */

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Model\LibBranch;

class LibraryBranchController extends Controller
{
    private $request, $error;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function all()
    {
        $all = LibBranch::all();
        if(empty($all->toArray()))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function branch($id)
    {
        $branch = LibBranch::find($id);
        if(empty($branch))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($branch, 200);
    }
    public function create()
    {
        $duplicate = LibBranch::where('branch', $this->request->input('branch'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Branch has been added before!', 401);
        }
        try
        {
            LibBranch::create($this->request->post());
            return response()->json('Branch Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'BRNADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $branch = LibBranch::find($id);
        if(empty($branch))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $branch->update($this->request->post());
            return response()->json('Branch Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'BRNUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $branch = LibBranch::find($id);
        if(empty($branch))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }

}
