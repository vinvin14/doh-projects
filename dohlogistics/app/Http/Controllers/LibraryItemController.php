<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 1:42 PM
 */

namespace App\Http\Controllers;

use App\Http\Model\FirstCategory;
use App\Http\Model\LibItem;
use App\Http\Model\SecondCategory;
use App\Http\Services\ErrorLogServices;
use App\Services\ErrorLoggingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryItemController
{
    private $request, $error;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function all()
    {
        $all = DB::table('libraryitem')
                    ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                    ->select('libraryitem.*', 'librarybranch.branch as branch')
                    ->orderBy('firstCategory', 'ASC')
                    ->get()
                    ->toArray();
        if(empty($all))
        {
            return response()->json('No Records found!', 404);
        }
        return response()->json($all, 200);
    }
    public function itemByBranch($branch)
    {
        if($branch === 'all')
        {
            $all = DB::table('libraryitem')
                ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                ->select('libraryitem.*', 'librarybranch.branch as branch')
                ->orderBy('firstCategory', 'ASC')
                ->get()
                ->toArray();
        }
        else
        {
            $all = DB::table('libraryitem')
                ->join('librarybranch', 'libraryitem.branch', '=', 'librarybranch.id')
                ->select('libraryitem.*', 'librarybranch.branch as branch')
                ->where('librarybranch.id', $branch)
                ->orderBy('firstCategory', 'ASC')
                ->get()
                ->toArray();
        }
        if(empty($all))
        {
            return response()->json('No Records found!', 404);
        }
        return response()->json($all, 200);
    }
    public function item($id)
    {
        $item = LibItem::find($id);
        if(empty($item))
        {
            return response()->json('Item not found!', 404);
        }
        return response()->json($item, 200);
    }
    public function create(ErrorLogServices $error)
    {
        $duplicate = LibItem::where([
            'firstCategory' => $this->request->input('firstCategory'),
            'secondCategory' => $this->request->input('secondCategory'),
        ])->first();
        if(! empty($duplicate))
        {
            return response()->json('This item has been added before!', 401);
        }
        try
        {
            //create distinct firstCat
//            $firsCat = FirstCategory::where('name', $this->request->input('firstCategory'))->first();
            if(empty(FirstCategory::where('name', $this->request->input('firstCategory'))->first()))
            {
                FirstCategory::create(['name' => $this->request->input('firstCategory')]);
            }
            if(empty(SecondCategory::where('name', $this->request->input('secondCategory'))->first()))
            {
                SecondCategory::create(['name' => $this->request->input('secondCategory')]);
            }
            LibItem::create($this->request->post());
            return response()->json('Item Successfully Added!', 200);
        }
        catch (Exception $exception)
        {
            $error->create([
                'user' => $_SESSION['user'],
                'module' => 'ITEMADD',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function update($id, ErrorLogServices $error)
    {
        $item = LibItem::find($id);
        if(empty($item))
        {
            return response()->json('Item not found!', 404);
        }
        try
        {
            $item->update($this->request->post());
            return response()->json('Successfully Updated!', 200);
        }
        catch (Exception $exception)
        {
            $error->create([
                'user' => $_SESSION['user'],
                'module' => 'ITEMUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong! Please contact your Administrator!', 501);
        }
    }
    public function delete($id)
    {
        $item = LibItem::find($id);
        if(empty($item))
        {
            return response()->json('Item not found!', 404);
        }
        $item->delete();
        return response()->json('Successfully Deleted!', 200);
    }
}
