@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Manage Category')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                    <a class=" float-end btn btn-sm btn_green rounded me-3" href="javascript:void(0)" onclick="toggle_modal('#m_barangay', '.barangay_form', ['#m_barangay_title','Add Barangay'], ['.btn_add_barangay','.btn_update_barangay'])">Add Barangay +</a><br>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered barangay_dt">
                            <caption>List of Barangay <i class="fas fa-tag ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                    <th>Lat</th>
                                    <th>Long</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Barangay --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection