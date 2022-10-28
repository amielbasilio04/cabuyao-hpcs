<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Date;
use App\Models\Admin\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DateTime\DateTimeRequest;

class DateTimeController extends Controller
{
    public function create()
    {
        return $this->res(['results' => Time::all()]);
    }

    public function store(DateTimeRequest $request)
    {
        $date_time_data = $request->validated();

        $date = Date::findOrFail($date_time_data['date_id']);

        $date->times()->attach($date_time_data['time_id']);

        return $this->res(['message' => 'Date Time Schedule Created Successfully']);
        
    }

    public function show($id)
    {
        return $this->res(['result' => Date::with('times')->where('id', $id)->first()]);
    }

    public function destroy($id)
    {
        $date = Date::findOrFail($id);

        $date->times()->detach(request('time'));

        return $this->res(['message' => 'Date Time Schedule Deleted Successfully']);

    }
}
