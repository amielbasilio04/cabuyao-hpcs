@extends('layouts.user.userdashboard')

@section('title', 'Brgy.Admin | Manage Event')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                    <a class=" float-end btn btn-sm btn_green rounded me-3" href="javascript:void(0)" onclick="toggle_modal('#m_event', '.event_form', ['#m_event_title','Add event'], ['.btn_add_event','.btn_update_event'])">Add Event +</a><br>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered event_dt py-3">
                            <caption>List of Health Program in my Barangay <i class="fas fa-laptop-medical ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Barangay</th>
                                    <th>Event Name</th>
                                    <th>Date Start</th>
                                    <th>Date End</th>
                                    <th>Is Approved</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Barangay --}}
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection