<?php
/**
 * Created by PhpStorm.
 * User: DOH-VIN
 * Date: 07/07/2020
 * Time: 10:39 AM
 */

namespace App\Http\Controllers;


use App\Http\Services\ErrorLogServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class APIController extends Controller
{
    private $request, $error, $input;

    public function __construct(Request $request, ErrorLogServices $error)
    {
        $this->request = $request;
        $this->error = $error;
    }

    public function itemSearch($term)
    {


        $dbm = explode('--', $term);
        if(! empty($dbm[1]))
        {
            if($dbm[0] == 'dbm')
            {
                $term = str_replace('%20', ' ', $term);

                $search = DB::table('librarydbm')
                    ->select(DB::raw('CONCAT(item," - (₱",price,")")text'), 'price as price', 'type as type', 'unit as unit', 'item as name', 'librarydbm.id as id', 'librarybranch.branch as branch')
                    ->join('librarybranch', 'librarydbm.branch', '=', 'librarybranch.id')
                    ->join('librarycategory', 'wfpreference.category', '=', 'librarycategory.id')
                    ->join('libraryunit', 'wfpreference.unit', '=', 'libraryunit.id')
                    ->where('item', 'like', '%'. $dbm[1] . '%')
                    ->get();
            }
        }
        else
        {
            $term = str_replace('%20', ' ', $term);
            $search = DB::table('wfpreference')
                            ->join('librarycategory', 'wfpreference.category', '=', 'librarycategory.id')
                            ->join('librarybranch', 'wfpreference.branch', '=', 'librarybranch.id')
                            ->join('libraryunit', 'wfpreference.unit', '=', 'libraryunit.id')
                            ->select(DB::raw('CONCAT(firstCategory,", ",secondCategory," - (₱",itemCost,")")text'), 'itemCost as price', 'libraryunit.id as unit', 'libraryunit.unit as unitname', 'wfpreference.id as id', 'librarycategory.category as category', 'librarybranch.branch as branch')
                            ->where(function ($query) use ($term){
                                $query->where('firstCategory', 'like', '%'. $term . '%')->orWhere('secondCategory', 'like', '%'. $term . '%');
//                                $query->whereRaw('firstCategory REGEXP "'. $term.'"')->orWhereRaw('secondCategory REGEXP "'. $term.'"');
//                                $query->whereRaw('MATCH (firstCategory, secondCategory, description) AGAINST (? IN BOOLEAN MODE)', $term);
                            })
                            ->get();
        }

        return response()->json([
            'items' => $search
        ], 200);
    }
    public function createWFPRef()
    {
        $approved = DB::table('librarytwg')
                            ->where('status', 'approved')
                            ->where('isWfpCreated', 'no')
                            ->get();
        foreach ($approved as $wfp)
        {
            //add libraryItem
            $libItem = DB::table('wfpreference')
                ->insertGetId([
                    'firstCategory' => $wfp->firstCategory,
                    'secondCategory' => $wfp->secondCategory,
                    'description' => $wfp->description,
                    'branch' => $wfp->branch,
                    'category' => $wfp->category,
                    'unit' => $wfp->unit,
                    'itemCost' => $wfp->itemCost,
                    'origin' => 'twg',
                ]);
            DB::table('librarytwg')
                ->where('id', $wfp->id)
                ->update(['isWfpCreated' => 'yes']);
        }
    }
    public function wfp()
    {
        $all = DB::table('wfpreference')
                        ->join('libraryunit', 'wfpreference.unit', 'libraryunit.id')
                        ->join('librarycategory', 'wfpreference.category', 'librarycategory.id')
                        ->join('librarybranch', 'wfpreference.branch', 'librarybranch.id')
                        ->select('wfpreference.*', 'libraryunit.unit as unit', 'librarycategory.category as category', 'librarybranch.branch as branch')
                        ->get();
        if(empty($all))
        {
            return response()->json(['status' => 404, 'response' => 'Item not found!']);
        }
        return $all;
    }
    public function updateWFP($id)
    {
        $wfp = DB::table('wfpreference')
            ->where('id', $id);
        if(empty($wfp->first()))
        {
            return 'No Record(s) Found!';
        }
        try
        {
            $wfp->update($this->request->post());
            return response()->json('Successfully Updated!', 200);
        }
        catch (\Exception $exception)
        {
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'WFPUPDATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function createWFP()
    {
        $duplicate = DB::table('wfpreference')
            ->where([
                'firstCategory' => $this->request->input('firstCategory'),
                'secondCategory' => $this->request->input('secondCategory'),
            ])
            ->first();
        if(! empty($duplicate))
        {
            return response()->json('Warning! This item has been added previously!', 401);
        }
        DB::beginTransaction();
        try
        {
//            print_r($this->request->post());
            $input = $this->request->post();
//            $input['isWfpCreated'] = 'no';
            DB::table('wfpreference')->insert($input);
            DB::commit();
            return response()->json('Successfully Created!', 200);
        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            $this->error->init([
                'user' => $_SESSION['user'],
                'module' => 'WFPCREATE',
                'details' => $exception->getMessage()
            ]);
            return response()->json('Something went wrong!, Please contact your administrator!', 501);
        }
    }
    public function twg()
    {
        $input = $this->request->post()['form_data'];
        unset($input['_token']);
        $duplicate = DB::table('librarytwg')
                        ->where([
                            'firstCategory' => $input['firstCategory'],
                            'secondCategory' => $input['secondCategory']
                        ])
                        ->first();
        if(! empty($duplicate))
        {
            return response()->json(['status' => 401, 'response' => 'This entry has been added previously!']);
        }
        try
        {
            $input['isWfpCreated'] = 'no';
            DB::table('librarytwg')
                    ->insert($input);
            return response()->json(['status' => 200, 'response' => 'TWG Request has been added, we will just wait for the approval of our TWG Members'] );
        }
        catch (\Exception $exception)
        {
            $this->error->init([
                'module' => 'TWGADD',
                'user' => 'outside',
                'details' => $exception->getMessage()
            ]);
            return response()->json(['status' => 501, 'response' => 'Oops something went wrong! Please contact your admin']);
        }
    }
    public function showTWG($id)
    {
        $twg = DB::table('librarytwg')
                        ->where('id', $id)
                        ->first();
        if(empty($twg))
        {
            return response()->json(['status' => 404, 'response' => 'Item not found!']);
        }
        return response()->json(['status' => 200, 'response' => $twg]);
    }
    public function updateTWG($id)
    {
        $input = $this->request->post()['form_data'];
        unset($input['_token']);
        $item = DB::table('librarytwg')->where('id', $id);
        if(empty($item->first()))
        {
            return response()->json(['status' => 404, 'response' => 'Item not found!']);
        }

        try
        {
            $item->update($input);
            $this->createWFPRef();
            return response()->json(['status' => 200, 'response' => 'TWG has been updated!']);
        }
        catch (\Exception $exception)
        {
            $this->error->init([
                'module' => 'TWGUPDATE',
                'user' => 'outside',
                'details' => $exception->getMessage()
            ]);
            return response()->json(['status' => 501, 'response' => 'Oops something went wrong! Please contact your admin']);
        }

    }
    public function pendingTWG()
    {
        $request = DB::table('librarytwg')
                        ->join('librarycategory', 'librarytwg.category', '=', 'librarycategory.id')
                        ->select('librarytwg.*', 'librarycategory.category as category', 'librarycategory.id as category_ID')
                        ->where('status', '=', 'pending')
                        ->get();
//                        ->toArray();
        if(empty($request))
        {
            return response()->json('No Record(s) Found!');
        }
        return $request;
    }
    public function category()
    {
        $all = DB::table('librarycategory')
                    ->get()
                    ->toArray();
        if(empty($all))
        {
            return response()->json('No Record(s) Found!');
        }
        return response()->json($all);
    }
}
