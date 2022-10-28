@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Manage Brgy. Admin')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                    <a class=" float-end btn btn-sm btn_green rounded me-3" href="javascript:void(0)" onclick="createBarangayAdmin()">Add Barangay Admin +</a><br>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered barangay_admin_dt py-3">
                            <caption>List of Barangay Admin <i class="fas fa-users ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Gender</th>
                                    <th>Assigned Barangay</th>
                                    <th>Is Activated</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Barangay Admin --}}
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