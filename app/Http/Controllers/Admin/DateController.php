<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Date;
use App\Models\Admin\Time;
use Illuminate\Http\Request;
use App\Models\Admin\Patient;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Date\DateRequest;
use Yajra\DataTables\Facades\DataTables;
use phpDocumentor\Reflection\Types\Null_;

class DateController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Date::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row)
            {
                

                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='btn btn-outline-default btn-sm' onclick='showDateTime($row->id)'><i class='fas fa-eye'></i></a>";


                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                onclick='c_destroy($row->id,`admin.date.destroy`,`.date_dt`)'><i class='fas fa-trash'></i></a>"; // crud destroy param [row or model ID, route name, datatableID]

                
                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                onclick='createDateTime($row)'>Add Schedule <i class='fas fa-plus-circle ms-1'></i> </a> 
                </div>"; // create schedule for date & time

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.date.index');
    }

    public function store(DateRequest $request)
    {
        $date_form_data = $request->validated();


        if(Date::whereIn('date', $date_form_data['date'])->get()->isNotEmpty())
        {
            return $this->error('Date already exist');
        }

        foreach($date_form_data['date'] as $date)
        {
           $date =  Date::create(['date' => $date]);

           $this->log_activity($date, 'added', 'Date', $date->date );

        }

        return $this->res(['message' => 'Patient Added Sucessfully']);
    }

    public function show(Date $date)
    {
        if(request()->ajax())
        {
            $available_schedule = DB::table('date_time')
                                    ->join('dates', 'date_time.date_id', 'dates.id')
                                    ->join('times', 'date_time.time_id', 'times.id')
                                    ->select('times.*', 'dates.date', 'date_time.id', 'date_time.date_id', 'date_time.status')
                                    ->where('date_time.date_id', $date->id)
                                    ->where('date_time.status', 0)
                                    ->get();

            $booked_schedule = DB::table('date_time')
                                    ->join('dates', 'date_time.date_id', 'dates.id')
                                    ->join('times', 'date_time.time_id', 'times.id')
                                    ->select('times.*', 'dates.date', 'date_time.id', 'date_time.date_id', 'date_time.status')
                                    ->where('date_time.date_id', $date->id)
                                    ->where('date_time.status', 1)
                                    ->get();

            return $this->res([$available_schedule, $booked_schedule]);
        }
    }

   
    public function update(Date $date)
    {
        if(request()->ajax())
        {
            $date->update(['date' => request('date')]);

            $this->log_activity($date, 'updated', 'Date', $date->date );

            return $this->success();
        }
    }

    public function destroy(Date $date)
    {
        $this->log_activity($date, 'deleted', 'Date', $date->date );

        $date->delete();

        return $this->res(['message' => 'Date Deleted Successfully']);
    }

    
}
