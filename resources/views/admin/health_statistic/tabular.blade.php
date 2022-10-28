@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Statistic')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered total_health_issue">
                            <caption>List of Total Health Issues Per barangay <i class="far fa-chart-bar ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                    <th>Health Issue Type</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Total Health Issues Per barangay--}}
                                @foreach ($health_profiles as $hp )
                                    <tr>
                                        <td>{{ $hp->name }}</td>
                                        <td>{{ $hp->type }}</td>
                                        <td>{{ $hp->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center py-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered total_family_history">
                            <caption>List of Total Family History Per barangay <i class="far fa-chart-bar ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                    <th>Health Issue Type</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Total Family History Per barangay--}}
                                @foreach ($family_history_profile as $fi )
                                    <tr>
                                        <td>{{ $fi->name }}</td>
                                        <td>{{ $fi->type }}</td>
                                        <td>{{ $fi->total }}</td>
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
{{--End CONTAINER--}}

@endsection