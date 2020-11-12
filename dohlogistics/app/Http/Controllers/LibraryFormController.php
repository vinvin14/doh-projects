<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 09/07/2020
 * Time: 1:02 PM
 */

namespace App\Http\Controllers;

use App\Http\Services\ErrorLogServices;
use App\Services\ErrorLoggingServices;
use App\Http\Model\LibForm;
use Illuminate\Http\Request;

class LibraryFormController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }

    public function all()
    {
        $all = LibForm::all();
        if(empty($all))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function category($id)
    {
        $form = LibForm::find($id);
        if(empty($form))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($form, 200);
    }
    public function create()
    {
        $duplicate = LibForm::where('form', $this->request->input('input'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Form has been added before!', 401);
        }
        try
        {
            LibForm::create($this->request->post());
            return response()->json('Form Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'FORMADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $form = LibForm::find($id);
        if(empty($form))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $form->update($this->request->post());
            return response()->json('Form Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'FORMUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $form = LibForm::find($id);
        if(empty($form))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
