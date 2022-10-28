@extends('layouts.user.userdashboard')

@section('title', 'Brgy. Admin | Calendar')

@section('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.css' rel='stylesheet' />
@endsection

@section('content')


{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" id="calendar">
               
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js'></script>
    <script>
        const events = {!! json_encode($events) !!}
         document.addEventListener('DOMContentLoaded', function() {
            const myCalendar = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(myCalendar, {
             height: 760,
            //initialView: 'dayGridMonth',
            initialView:'timeGridWeek',
            eventColor: '#5db75a',
            eventBackgroundColor:'#5db75a',
            eventMaxStack: 1,
            expandRows: true,
            eventMouseEnter: function(info) {
                $(info.el).tooltip({ title: info.event.title });
            },
            events
            // eventSources: [
            //    {
            //     events,
            //     defaultAllDay : true,
            //     display: 'list-item',
            //     backgroundColor: '#5db75a'
            //    }
            // ]
            });
            calendar.render();
        });

    </script>
@endsection