<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 12:59 PM
 */

namespace App\Http\Controllers;

use App\Http\Services\ErrorLogServices;
use App\Http\Model\LibCategory;
use Illuminate\Http\Request;
class LibraryCategoryController
{
    private $request, $error;

    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }
    public function all()
    {
        $all = LibCategory::all();
        if(empty($all))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function category($id)
    {
        $category = LibCategory::find($id);
        if(empty($category))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($category, 200);
    }
    public function create()
    {
        $duplicate = LibCategory::where('category', $this->request->input('category'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Category has been added before!', 401);
        }
        try
        {
            LibCategory::create($this->request->post());
            return response()->json('Category Successfully Added!', 200);
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
    public function update($id)
    {
        $category = LibCategory::find($id);
        if(empty($category))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $category->update($this->request->post());
            return response()->json('Category Successfully Updated!');
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
        $category = LibCategory::find($id);
        if(empty($category))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
