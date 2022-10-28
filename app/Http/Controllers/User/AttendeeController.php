<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\Attendee;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\Attendee\AttendeeRequest;

class AttendeeController extends Controller
{
    public function store(AttendeeRequest $request)
    {
        $attendee = Attendee::create($request->validated());

        $this->log_activity($attendee, 'added', 'Attendee', $attendee->full_name );

        return $this->res(['result' => $attendee]);
    }

    public function update(AttendeeRequest $request, Attendee $attendee)
    {
        $attendee->update($request->validated());

        $this->log_activity($attendee, 'updated', 'Attendee', $attendee->full_name );

        return $this->res(['result' => $attendee]);

    }

    public function destroy(Attendee $attendee)
    {
        $this->log_activity($attendee, 'deleted', 'Attendee', $attendee->full_name );

        $attendee->delete();

        return $this->res(['message' => 'Attendee Deleted Successfully']);
    }
}
