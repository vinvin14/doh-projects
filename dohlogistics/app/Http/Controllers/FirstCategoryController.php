<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 22/07/2020
 * Time: 9:35 AM
 */

namespace App\Http\Controllers;


use App\Http\Model\FirstCategory;
use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;

class FirstCategoryController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }
    public function all()
    {
        $all = FirstCategory::orderBy('name');
        if(empty($all))
        {
            return response()->json('No Record(s) Found!', 404);
        }
    }
    public function create()
    {
        $duplicate = FirstCategory::where('name', $this->request->input('name'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This record has been added before!', 401);
        }
        try
        {
            FirstCategory::create($this->request->post());
            return response()->json('Successfully Created!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'FCATADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
}
