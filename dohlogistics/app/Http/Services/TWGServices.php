<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 06/10/2020
 * Time: 11:37 AM
 */

namespace App\Http\Services;


use Illuminate\Support\Facades\DB;

class TWGServices
{
    private $view, $config, $error;
    public function __construct(DisplayServices $view, ConfigurationServices $config, ErrorLogServices $error)
    {
        $this->view = $view;
        $this->config['sidebar'] = $config->initConfig();
    }
    public function all()
    {
        $all = DB::table('librarytwg')
                        ->join('libraryunit', 'librarytwg.unit', '=', 'libraryunit.id')
                        ->join('librarycategory', 'librarytwg.category', '=', 'librarycategory.id')
                        ->join('librarybranch', 'librarytwg.branch', '=', 'librarycategory.id')
                        ->get();
        if(empty($all))
        {
            return 'No Record(s) Found!';
        }
        return $all;
    }
    public function allByStatus($status)
    {
        $request = DB::table('librarytwg')
                            ->join('libraryunit', 'librarytwg.unit', '=', 'libraryunit.id')
                            ->join('librarycategory', 'librarytwg.category', '=', 'librarycategory.id')
                            ->join('librarybranch', 'librarytwg.branch', '=', 'librarybranch.id')
                            ->select('librarytwg.*', 'libraryunit.unit as unit', 'librarycategory.category as category', 'librarybranch.branch as branch')
                            ->where('status', $status)
                            ->orderBy('firstCategory', 'asc')
                            ->get();
        if(empty($request))
        {
            return 'No Record(s) Found!';
        }
        return $request;
    }
    public function request($id)
    {
        $request = DB::table('librarytwg')
                            ->where('id', $id)
                            ->first();
        if(empty($request))
        {
            return 'No Record(s) Found!';
        }
        return $request;
    }
    public function create()
    {
        $duplicate = DB::table('librarytwg')
                            ->where([
                                'firstCategory' => $this->request->input('firstCategory'),
                                'secondCategory' => $this->request->input('secondCategory'),
                                'branch' => $this->request->input('branch'),
                                'category' => $this->request->input('category'),
                            ])
                            ->first();
        if(empty($duplicate))
        {
            return 'No Record(s) Found!';
        }
        DB::beginTransaction();
        try
        {
            DB::table('librarytwg')
                    ->insert($this->request->post());
            DB::commit();
            return 'TWG Request has been submitted and is subject for approval';
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'TWGADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function update($id)
    {
        $request = DB::table('librarytwg')
                            ->where('id', $id);
        if(empty($request->first()))
        {
            return 'No Record(s) Found!';
        }
        DB::beginTransaction();
        try
        {
            $request->update($this->request->post());
            DB::commit();
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'TWGUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function wfp()
    {
        $wfp = DB::table('wfpreference')
                        ->join('libraryunit', 'wfpreference.unit', '=', 'libraryunit.id')
                        ->join('librarycategory', 'wfpreference.category', '=', 'librarycategory.id')
                        ->join('librarybranch', 'wfpreference.branch', '=', 'librarybranch.id')
                        ->select('wfpreference.*', 'libraryunit.unit as unit', 'librarycategory.category as category', 'librarybranch.branch as branch')
                        ->orderBy('firstCategory', 'ASC')
                        ->orderBy('secondCategory', 'ASC')
                        ->paginate(50);
        if(empty($wfp))
        {
            return 'No Record(s) Found!';
        }
        return $wfp;
    }
    public function wfpCreate()
    {
        $duplicate = DB::table('wfpreference')
                            ->where([
                                'firstCategory' => $this->request->input('firstCategory'),
                                'secondCategory' => $this->request->input('secondCategory'),
                            ])
                            ->first();
        if(! empty($duplicate))
        {
            return 'Warning! This item has been added previously!';
        }
        DB::beginTransaction();
        try
        {
            $input = $this->request->post();
            $input['isWfpCreated'] = 'no';
            DB::table('wfpreference')->insert($input);
            return 'Successfully Created!';

            DB::commit();
        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'TWGUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function wfpShow($id)
    {
        $wfp = DB::table('wfpreference')
                        ->join('libraryunit', 'wfpreference.unit', '=', 'libraryunit.id')
                        ->join('librarycategory', 'wfpreference.category', '=', 'librarycategory.id')
                        ->join('librarybranch', 'wfpreference.branch', '=', 'librarybranch.id')
                        ->where('wfpreference.id', $id)
                        ->select('wfpreference.*', 'libraryunit.unit as unit', 'librarycategory.category as category', 'librarybranch.branch as branch',
                            'librarybranch.id as branchID', 'libraryunit.id as unitID', 'librarycategory.id as categoryID')
                        ->first();
        if(empty($wfp))
        {
            return 'No Record(s) Found!';
        }
        return $wfp;
    }
    public function wfpUpdate($id, $input)
    {
        $wfp = DB::table('wfpreference')
                        ->where('id', $id)
                        ->first();
        if(empty($wfp))
        {
            return 'No Record(s) Found!';
        }
        DB::beginTransaction();
        try
        {
            DB::table('wfpreference')
                ->where('id', $id)
                ->update($input);
            return response()->json('Successfully Updated!', 200);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'WFPUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function wfpDelete($id)
    {
        $wfp = DB::table('wfpreference')
                        ->where('id', $id);
        if(empty($wfp->first()))
        {
            return 'No Record(s) Found!';
        }
        $wfp->delete();
        return 'Successfully Deleted!';
    }
}
