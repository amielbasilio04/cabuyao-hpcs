<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Time\TimeRequest;
use Yajra\DataTables\Facades\DataTables;

class TimeController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Time::all())
            ->addIndexColumn()
            ->addColumn('actions', function($row){

                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='btn btn-outline-default btn-sm' onclick='c_edit(`#m_time`, `.time_form :input`, [`#m_time_title`, `Edit Time`], [`.btn_add_time`, `.btn_update_time`], $row)'><i class='fas fa-edit'></i></a>";

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                onclick='c_destroy($row->id,`admin.time.destroy`,`.time_dt`)'><i class='fas fa-trash'></i></a>
                </div>"; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        
        return view('admin.time.index');
    }

    public function store(TimeRequest $request)
    {
        $time_data = $request->validated();

        $check_time_exist = Time::where('from', $time_data['from'])
                      ->where('to', $time_data['to'])
                      ->first();
        if($check_time_exist) {
            return $this->error('Time schedule already exist');
        }

        $time =  Time::create($time_data);

        $this->log_activity($time, 'added', 'Time', formatTime($time->from) . ' - ' . formatTime($time->to));

        return $this->res(['message' => 'Time Added Sucessfully']);
    }


    public function edit(Time $time)
    {
        if(request()->ajax())
        {
            return $this->res($time);
        }
    }

    public function update(TimeRequest $request, Time $time)
    {
        $time_data = $request->validated();
        $time->update($time_data);

        $this->log_activity($time, 'updated', 'Time', formatTime($time->from) . ' - ' . formatTime($time->to));

        return $this->res(['message' => 'Time Updated Sucessfully']);


    }

    public function destroy(Time $time)
    {
        $this->log_activity($time, 'deleted', 'Time', formatTime($time->from) . ' - ' . formatTime($time->to));
        
        $time->delete();

        return $this->res(['message' => 'Time Deleted Sucessfully']);

    }
}
