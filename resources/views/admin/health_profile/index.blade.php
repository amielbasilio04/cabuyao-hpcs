@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Resident Health Profile')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                    <a class=" float-end btn btn-sm btn_green rounded me-3" href="javascript:void(0)" onclick="createHealthProfile()">Add Health Profile +</a><br>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered health_profile_dt py-3">
                            <caption>List of Resident's Health Profile <i class="fas fa-head-side-mask ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Barangay</th>
                                    <th>Family History</th>
                                    <th>Health Issue</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Health Issue --}}
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