@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Event Information')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body p-0">
                <div class="row text-center">
                    <div class="col-4 col-md-3 col-lg-2 p-3 bg_green">
                      <br>
                      <h1 class="text-white display-4">{{ date('d', strtotime($event->time_start)) }} </h1>
                      <h3 class="text-white">{{ date('M Y', strtotime($event->time_start)) }}  <i class="far fa-calendar"></i></h3>
                      <h4 class="text-white">{{ formatDate($event->time_start, 'time') }}</h4>
                    </div>
                    <div class="col-8 col-md-9 col-lg-10 p-3 bg_navy_blue">
                      <h2 class="fw-light text-white">{{ $event->name }} <i class="far fa-calendar ms-1"></i></h2>
                      <p class="text-white"><q> {{ $event->description }} </q></p>
                      <p class="lead text-white">{{ $event->location }}</p>
                      <p class="lead text-white">@ Brgy. {{ $event->barangay->name }}</p>
                      <p class="lead text-white"><i class="far fa-clock"></i> To {{ formatDate($event->time_end, 'dateTime') }}</p>
                    </div>
                </div>
              </div>
          </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
              <div class="card-body p-0">
                <div class="row text-center">
                    <div class="col-md-3 col-lg-2 p-3 bg_green align-items-center d-none d-md-block">
                      <h2 class="text-white">{{ $event->organizer }} </h2>
                      <h4 class="text-white">Event Organizer <i class="fas fa-user-edit ms-1"></i></h4>
                      <img class="img-fluid" src="{{ asset('img/event/event_info.svg') }}" alt="">
                    </div>
                    <div class="col-12 col-md-9 col-lg-10 p-3 bg_navy_blue">
                      <h2 class="fw-light text-white">Attendees <i class="fas fa-users ms-1"></i>
                        <a class="float-end btn btn-sm btn_green rounded" href="javascript:void(0)" onclick="createAttendee({{ $event->id }})">Create <i class="fas fa-plus-circle ms-1"></i> </a>
                      </h2>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-sm text-dark table-borderless table-hover bg-white rounded">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Gender</th>
                                  <th>Contact</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody id="d_attendees">
                              @foreach ($event->attendees as $attendee )
                                  <tr id="row_attendee-{{ $attendee->id }}">
                                      <td>{{ $attendee->full_name }}</td>
                                      <td>{{ $attendee->gender }}</td>
                                      <td>{{ $attendee->contact }}</td>
                                      <td>
                                          <div class="btn-group">
                                              <a class="btn btn-sm btn_green text-white rounded" href="javascript:void(0)" onclick='c_edit(`#m_attendee`, `.attendee_form :input`, [`#m_attendee_title`, `Edit Attendee`], [`.btn_add_attendee`, `.btn_update_attendee`], {{ $attendee }})'><i class="fas fa-edit"></i></a>
                                              <a class="btn btn-sm btn-danger rounded ms-1" href="javascript:void(0)" onclick="removeAttendee({{ $attendee->id }})"> <i class="fas fa-trash"></i></a>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                      </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection