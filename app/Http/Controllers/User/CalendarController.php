<?php

namespace App\Http\Controllers\User;

use App\Models\Admin\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        foreach(Event::with('barangay', 'attendees')->where('is_approved',1)->where('barangay_id', auth()->user()->barangay_id)->get() as $event) {
            $total_attendees = $event->attendees->count();
            $barangay = $event->barangay->name;
            $title = "$event->name at $barangay & Total Attendees - $total_attendees";
            $events[] = [
                'title' => $title ,
                'start' => $event->time_start,
                'end' => $event->time_end,
                'allDay' => false,
                'eventResizableFromStart' => true,
                'url' => route('brgy_admin.event.show', $event->id)
            ];
        }
        
        return view('user.event.calendar.index', compact('events'));
    }
}
