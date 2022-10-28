@extends('layouts.user.userdashboard')

@section('title', 'Brgy. Admin | Edit Health Profile')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn_navy_blue text-decoration-none text-white" href="{{ route('brgy_admin.health_profile.index') }}"><i class="fas fa-chevron-left me-1"></i>Go Back</a>
                </div>
                <div class="card-body">
                  <form action="{{ route('brgy_admin.health_profile.update', $health_profile->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <h3 class="txt_navy_blue">Resident Info <i class="fas fa-info-circle ms-1"></i></h3>
                            <br>
                            <div class="form-group mb-2">
                                <label class="form-label">First Name:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->fname }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Middle Name:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->mname }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Last Name:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->lname }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Suffix:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->suffix }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Gender:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->gender }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Birth Date:</label>
                                <input class="form-control" type="text" value="{{ formatDate($health_profile->resident->birthdate) }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Address:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->address }}" readonly>
                            </div>

                            <div class="form-group mb-2">
                                <label class="form-label">Barangay:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->barangay->name }}" readonly>
                            </div>
                            <div class="form-group mb-5">
                                <label class="form-label">Contact:</label>
                                <input class="form-control" type="text" value="{{ $health_profile->resident->contact }}" readonly>
                            </div>
                        
                       
                        </div>
                        <div class="col-md-4">
                            <h3 class="txt_navy_blue">Health Profile <i class="fas fa-info-circle ms-1"></i></h3>
                            <br>
                          {{-- <img class="img-fluid rounded-circle d-block mx-auto" src="{{ asset('img/noimg.svg') }}" width="125" alt="health_profile">
                          <br> --}}
                            @if(session('message'))
                                <div class="alert alert-info alert-dismissible fade show p-3" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show p-3" role="alert"">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                          <div class="form-group mb-2">
                                <label class="form-label">Family History:</label>
                                <select class="select2" name="family_history_id" id="d_family_history">
                                    @foreach ($family_histories as $fh )
                                        <option value="{{ $fh->id }}" @if($fh->id === $health_profile->family_history_id) selected @endif>
                                            {{ $fh->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Health Issue:</label>
                                <select class="select2" name="health_issue_id" id="d_health_issue">
                                    @foreach ($health_issues as $hi )
                                        <option value="{{ $hi->id }}" @if($hi->id === $health_profile->health_issue_id) selected @endif>
                                            {{ $hi->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Guardian:</label>
                                <input class="form-control" type="text" name="guardian" value="{{ $health_profile->guardian }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Address:</label>
                                <input class="form-control" type="text" name="address" value="{{ $health_profile->address }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Contact:</label>
                                <input class="form-control" type="number" min="0" name="contact" value="{{ $health_profile->contact }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="form-label">Relationship:</label>
                                <input class="form-control" type="text" name="relationship" value="{{ $health_profile->relationship }}">
                            </div>
                            <button type="submit" class="btn btn_navy_blue float-end">Update</button>
                        </div>
                    </div>
                
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection
@section('script')
    <script>
        $(() => {
            $('#d_health_issue').select2()
            $('#d_family_history').select2()
        })
    </script>
@endsection