<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
   public function index()
   {
        if(request()->ajax())
        {
            $activities = Activity::where('causer_type', 'App\Models\User')
                                    ->where('causer_id', auth()->id())
                                    ->latest()->get();

            return DataTables::of($activities)
                ->addIndexColumn()
                ->addColumn('actions', function($row) {

                    $btn = " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                    onclick='c_destroy($row->id,`admin.activity.destroy`,`.activitylog_dt`)'><i class='fas fa-trash'></i></a>"; // crud destroy param [row or model ID, route name, datatableID]

                    return $btn;

                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        
        return view('user.activitylog.index'); 
    }
}
