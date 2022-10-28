@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Health Statistic Map')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-5">
                      <h1 class="card-text text-center txt_navy_blue fw-bold">
                        MAP SUMMARY <i class="fas fa-map-marked-alt ms-1"></i>
                      </h1>
                    </div>
                    <div class="col-md-4">
                      <select class="form-select" name="health_issue_id" onchange="getStatisticByFamilyHistory(this)">
                        <option value="">--Select--</option>
                        @foreach ($family_histories_issue as $family_history )
                          <option value="{{ $family_history->id }}" data-value='{{ $family_history->type }}'>Generate statistic for {{ $family_history->type }} by different Barangay</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                  
                </div>
                <br>
                <div class="card-body vh-100" id="mapid">
                    
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection
@section('script')
<script src="{{ asset('js/shared/statistic.js') }}"></script>
@endsection