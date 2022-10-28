<?php

namespace App\Http\Controllers\Admin;

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
            return DataTables::of(Activity::latest()->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                    onclick='c_destroy($row->id,`admin.activity.destroy`,`.activitylog_dt`)'><i class='fas fa-trash'></i></a>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        return view('admin.activitylog.index');  
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();

        return $this->res(['message' => 'Activity Deleted Successfully']);
    }
}
