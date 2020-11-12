<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 28/07/2020
 * Time: 1:22 PM
 */

namespace App\Http\Controllers;


class LibraryProgramController extends Controller
{
    private $request, $error;
    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }
    public function all()
    {
        $all = LibProgram::orderBy('firstCategory')->get();
        if(empty($all->toArray()))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($all, 200);
    }
    public function program($id)
    {
        $program = LibProgram::find($id);
        if(empty($program))
        {
            return response()->json('No Records Found!', 404);
        }
        return response()->json($program, 200);
    }
    public function create()
    {
        $duplicate = LibProgram::where('program', $this->request->input('program'))->first();
        if(! empty($duplicate))
        {
            return response()->json('This Program record has been added before!', 401);
        }
        try
        {
            LibProgram::create($this->request->post());
            return response()->json('Program record Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'PRGADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id)
    {
        $program = LibProgram::find($id);
        if(empty($program))
        {
            return response()->json('No Record(s) Found!');
        }
        try
        {
            $program->update($this->request->post());
            return response()->json('Program Successfully Updated!');
        }
        catch (Exception $exception)
        {
            $this->error->create([
                'user' => $_SESSION['user'],
                'module' => 'PRGUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function destroy($id)
    {
        $program = LibProgram::find($id);
        if(empty($program))
        {
            return response()->json('No Record(s) Found!', 404);
        }

    }
}
