@extends('layouts.user.userdashboard')

@section('content')
<main class="content">
    <div class="container-fluid pe-5">

        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3 class="txt_default"><strong>My</strong> Dashboard</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex align-self-stretch">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card bg_green">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.resident.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Residents</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_residents }}</h1>
                                </div>
                            </div>
                            <div class="card bg_navy_blue">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.event.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Events</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_events }}</h1>
                                </div>
                            </div>
                            <div class="card bg_green">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.health_statistic.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Health Issues</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_health_issues }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card bg_green">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.health_profile.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Health Profile</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_health_profiles }}</h1>
                                </div>
                            </div>
                            <div class="card bg_navy_blue">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.event.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Pending Events</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_pending_events }}</h1>
                                </div>
                            </div>
                            <div class="card bg_green">
                                <div class="card-body d-flex and flex-column">
                                    <a href="{{ route("brgy_admin.event.index") }}" class="card-title mb-4 text-white text-decoration-none">Total Canceled Events</a>
                                    <h1 class="mt-1 mb-3 text-white">{{ $total_canceled_events }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7 d-flex align-self-stretch">
                <div class="card flex-fill w-100">
                    <div class="card-header bg_navy_blue">
                        <h5 class="card-title mb-0 text-white">Map Summary <i class="fas fa-map-marker-alt text-danger ms-1"></i></h5>
                    </div>
                    <div class="card-body py-3 d-flex and flex-column vh-50" id="mapid">
                           {{--Display Map Summary--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="chart chart-sm">
                    <canvas id="chart_total_residents_by_barangay">
                        {{--Display Total Residents by Barangay--}}
                    </canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="chart chart-sm">
                        <canvas id="chart_total_health_issues_by_barangay">
                            {{--Display Total Health Issues By Barangay--}}
                        </canvas>
                    </div>
                  </div>
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Activity Logs</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($activities as $al )
                            @php
                            $exploaded = explode('-',$al->description);
                            @endphp
                            <div class='border-start border-3 border-secondary'>
                            <p class="m-0 ps-2">{{ $exploaded[0] }} - <span class='txt_default'> {{ $exploaded[1] }} </span>  </p>
                            <p class='ps-2'> {{ $al->created_at->diffForHumans() }} </p>
                            </div>
                        @endforeach
                        <p class="text-center">
                            <a class="txt_default" href="{{ route('brgy_admin.activity.index') }}">View all</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">My Recent Residents <i class="fas fa-users ms-1"></i> </h5>
                    </div>
                    <div class="card-body px-4">
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="d-none d-xl-table-cell">Gender</th>
                                    <th class="d-none d-xl-table-cell">Registed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $my_residents as $resident )
                                    <tr>
                                        <td>{{ $resident->full_name }}</td>
                                        <td>{{ $resident->gender }}</td>
                                        <td class="d-none d-xl-table-cell">{{ formatDate($resident->created_at) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No Data Found</td>
                                    </tr>
                                @endforelse
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                <div class="card flex-fill">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Calendar</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="chart">
                                <div id="datetimepicker-dashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>
@endsection


@section('script')
<script src="{{ asset('js/shared/statistic.js') }}"></script>

<script>
        const barangays = {!! json_encode($barangays) !!}
        const total_residents = {!! json_encode($residents) !!}
        const hp_barangays = {!! json_encode($hp_barangays) !!}
        const hp_total_health_issues = {!! json_encode($hp_total_health_issues) !!}


        const my_chart = document.getElementById('chart_total_residents_by_barangay');
		const chart_total_residents_by_barangay = new Chart(my_chart,{
			type:'doughnut', // bar , horizontal, line ,doughnut ,radar , polarArea
			data:{
				labels:barangays,
				datasets:[{
					label:'Total Residents in my Barangay',
					data: total_residents,
					backgroundColor:[
					'rgba(213, 75, 126,1.0)',
					'rgba(52, 152, 219,1.0)',
					'rgba(155, 89, 182,1.0)',
					'rgba(52, 73, 94,1.0)',
					'rgba(230, 126, 34,1.0)',
					'rgba(241, 196, 15,1.0)',
                    'rgba(231, 76, 60,1.0)',
                    'rgba(241, 196, 15,1.0)',
                    'rgba(127, 140, 141,1.0)',
                    'rgba(44, 62, 80,1.0)',
                    'rgba(26, 188, 156,1.0)',
                    'rgba(108, 92, 231,1.0)',
                    'rgba(253, 121, 168,1.0)',
                    'rgba(225, 112, 85,1.0)',
                    'rgba(255, 234, 167,1.0)',
                    'rgba(0, 184, 148,1.0)',
                    'rgba(162, 155, 254,1.0)',
                    'rgba(253, 203, 110,1.0)'
				]
				}],
				
			},
			options:{
				title: {
					display: true,
					text: 'Total Residents in my Barangay'
				}
			}
		});

        const my_chart2 = document.getElementById('chart_total_health_issues_by_barangay');
		const chart_total_health_issues_by_barangay = new Chart(my_chart2,{
			type:'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
			data:{
				labels:hp_barangays,
				datasets:[{
					label:'Total Health Issues in my Barangay',
					data: hp_total_health_issues,
					backgroundColor:[
					'rgba(213, 75, 126,1.0)',
					'rgba(52, 152, 219,1.0)',
					'rgba(155, 89, 182,1.0)',
					'rgba(52, 73, 94,1.0)',
					'rgba(230, 126, 34,1.0)',
					'rgba(241, 196, 15,1.0)',
                    'rgba(231, 76, 60,1.0)',
                    'rgba(241, 196, 15,1.0)',
                    'rgba(127, 140, 141,1.0)',
                    'rgba(44, 62, 80,1.0)',
                    'rgba(26, 188, 156,1.0)',
                    'rgba(108, 92, 231,1.0)',
                    'rgba(253, 121, 168,1.0)',
                    'rgba(225, 112, 85,1.0)',
                    'rgba(255, 234, 167,1.0)',
                    'rgba(0, 184, 148,1.0)',
                    'rgba(162, 155, 254,1.0)',
                    'rgba(253, 203, 110,1.0)'
				]
				}],
				
			},
			options:{
				title: {
					display: true,
					text: 'Total Health Issues in my Barangay'
				}
			}
		});


        document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: '<span title="Previous month">&laquo;</span>',
            nextArrow: '<span title="Next month">&raquo;</span>',
        });
    });


</script>

@endsection

