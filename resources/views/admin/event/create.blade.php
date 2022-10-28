@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Create Event')

@section('content')

{{-- CONTAINER --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <h2 class="text-center fw-normal txt_green">Add Event <div class="i far fa-calendar ms-1"></div> </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('city_admin.event.store') }}" method="post">
                        @csrf
                        
                        @include('layouts.alert')

                        <div class="form-group mb-3">
                            <select class="select2" name="barangay_id" id="d_barangay" value="{{old('barangay_id')}}" required>
                                <option value="">--- select barangay ---</option>
                                @foreach ($barangays as $barangay )
                                    <option value="{{ $barangay->id }}"> {{ $barangay->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Event Name *</label>
                            <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Description *</label>
                            <textarea class="form-control" name="description" rows="5" value="{{old('description')}}" required></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Event Location *</label>
                            <input class="form-control" type="text" name="location" value="{{old('location')}}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Organizer *</label>
                            <input class="form-control" type="text" name="organizer" value="{{old('organizer')}}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Contact *</label>
                            <input class="form-control" type="number" min="0" name="contact" value="{{old('contact')}}" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">DateTime Start *</label>
                            <input class="form-control" type="datetime-local" min="2021-10-01T00:00" max="2022-01-01T00:00" name="time_start" value="{{old('time_start')}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">DateTime End *</label>
                            <input class="form-control" type="datetime-local" min="2021-10-01T00:00" max="2022-01-01T00:00" name="time_end"  value="{{old('time_end')}}" required>
                            <div class="form-text">Note* Please double check the schedule before encoding</div>
                        </div>
                        <button type="submit" class="btn btn_green float-end">Submit</button>
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
            $('#d_barangay').select2()
        })
    </script>
@endsection