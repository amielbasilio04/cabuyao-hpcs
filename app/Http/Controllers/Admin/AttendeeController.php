<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Attendee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\Attendee\AttendeeRequest;

class AttendeeController extends Controller
{
    public function store(AttendeeRequest $request)
    {
        return $this->res(['result' => Attendee::create($request->validated())]);
    }

    public function update(AttendeeRequest $request, Attendee $attendee)
    {
        $attendee->update($request->validated());

        return $this->res(['result' => $attendee]);

    }

    public function destroy(Attendee $attendee)
    {
        $attendee->delete();

        return $this->res(['message' => 'Attendee Deleted Successfully']);
    }
}
