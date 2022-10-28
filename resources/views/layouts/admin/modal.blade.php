@if(url()->current() === route('city_admin.barangay.index'))
    {{--Creating Barangay--}}
    <div class="modal fade" id="m_barangay" tabindex="-1" role="dialog" aria-labelledby="m_barangay_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_barangay_header">
            <h5 class="modal-title text-white" id="m_barangay_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="barangay_form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="form-label">Barangay *</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Latitude *</label>
                        <input class="form-control" type="number" name="lat">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Longitude *</label>
                        <input class="form-control" type="number" name="long">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_barangay btn_green"  onclick="c_store('.barangay_form','.barangay_dt', 'city_admin.barangay.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_barangay btn_navy_blue"  onclick="c_update('.barangay_form','.barangay_dt', 'city_admin.barangay.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Barangay--}}
@endif


@if(url()->current() === route('city_admin.resident.index'))
    {{--Creating Resident--}}
    <div class="modal fade" id="m_resident" tabindex="-1" role="dialog" aria-labelledby="m_resident_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_resident_header">
            <h5 class="modal-title text-white" id="m_resident_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="resident_form" autocomplete="off">
                    <div class="form-group mb-2">
                        <label class="form-label">First Name *</label>
                        <input class="form-control" type="text" name="fname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Middle Name *</label>
                        <input class="form-control" type="text" name="mname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Last Name *</label>
                        <input class="form-control" type="text" name="lname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Suffix *</label>
                        <input class="form-control" type="text" name="suffix">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Gender *</label>
                        <select class="form-select" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Birth Date *</label>
                        <input class="form-control" type="date" min="1980-01-01" max="2000-01-01" name="birthdate">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Address *</label>
                        <input class="form-control" type="text" name="address">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Barangay *</label>
                        <select class="form-select" name="barangay_id" id="d_barangay">
                           {{--Display List of Barangay--}}
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Contact *</label>
                        <input class="form-control" type="number" min="0" name="contact">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Email *</label>
                        <input class="form-control" type="email" name="email">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_resident btn_green"  onclick="c_store('.resident_form','.resident_dt', 'city_admin.resident.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_resident btn_navy_blue"  onclick="c_update('.resident_form','.resident_dt', 'city_admin.resident.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Resident--}}
@endif



@if(url()->current() === route('city_admin.barangay_admin.index'))
    {{--Creating Brgy Admin--}}
    <div class="modal fade" id="m_barangay_admin" tabindex="-1" role="dialog" aria-labelledby="m_barangay_admin_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_barangay_admin_header">
            <h5 class="modal-title text-white" id="m_barangay_admin_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="barangay_admin_form" autocomplete="off">
                    <div class="form-group mb-2">
                        <label class="form-label">Resident *</label>
                        <select class="form-select" name="resident_id" id="d_resident">
                           {{--Display List of Resident--}}
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label">Barangay *</label>
                        <select class="form-select" name="barangay_id" id="d_barangay">
                           {{--Display List of Barangay--}}
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_barangay_admin btn_green"  onclick="c_store('.barangay_admin_form','.barangay_admin_dt', 'city_admin.barangay_admin.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_barangay_admin btn_navy_blue"  onclick="c_update('.barangay_admin_form','.barangay_admin_dt', 'city_admin.barangay_admin.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Brgy. Admin--}}

      {{--Editing Brgy Admin--}}
      <div class="modal fade" id="m_edit_ba" tabindex="-1" role="dialog" aria-labelledby="m_edit_ba_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-white" id="m_edit_ba_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="edit_ba_form" autocomplete="off">
                    <div class="form-group mb-2">
                        <label>Barangay Admin *</label>
                       <input class="form-control" type="text" id="d_brgy_admin" readonly>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label">Barangay *</label>
                        <select class="form-select" name="barangay_id" id="d_barangays">
                           {{--Display List of Barangay--}}
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_update_barangay_admin btn_navy_blue"  onclick="c_update('.edit_ba_form','.barangay_admin_dt', 'city_admin.barangay_admin.update', event, {title:'Do you want to transfer this Brgy. Admin?', text:'', confirmTxt:'Yes transfer it!'})">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Editing Brgy. Admin--}}
@endif


@if(url()->current() === route('city_admin.health_issue.index'))
    {{--Creating Health Issue--}}
    <div class="modal fade" id="m_health_issue" tabindex="-1" role="dialog" aria-labelledby="m_health_issue_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_health_issue_header">
            <h5 class="modal-title text-white" id="m_health_issue_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="health_issue_form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="form-label">Type *</label>
                        <input class="form-control" type="text" name="type">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_health_issue btn_green"  onclick="c_store('.health_issue_form','.health_issue_dt', 'city_admin.health_issue.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_health_issue btn_navy_blue"  onclick="c_update('.health_issue_form','.health_issue_dt', 'city_admin.health_issue.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Health Issue--}}
@endif

@if(url()->current() === route('city_admin.family_history.index'))
    {{--Creating Family History--}}
    <div class="modal fade" id="m_family_history" tabindex="-1" role="dialog" aria-labelledby="m_family_history_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_family_history_header">
            <h5 class="modal-title text-white" id="m_family_history_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="family_history_form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="form-label">Type *</label>
                        <input class="form-control" type="text" name="type">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_family_history btn_green"  onclick="c_store('.family_history_form','.family_history_dt', 'city_admin.family_history.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_family_history btn_navy_blue"  onclick="c_update('.family_history_form','.family_history_dt', 'city_admin.family_history.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Family History--}}
@endif


@if(url()->current() === route('city_admin.health_profile.index'))
    {{--Creating Health Profile --}}
    <div class="modal fade" id="m_health_profile" tabindex="-1" role="dialog" aria-labelledby="m_health_profile_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_health_profile_header">
            <h5 class="modal-title text-white" id="m_health_profile_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="health_profile_form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="form-label">Select Barangay *</label>
                        <select class="form-select" name="barangay_id" id="d_barangay" onchange="displayResidentByBarangay(this)">
                            {{--Display List of Barangays--}}
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Select Resident *</label>
                        <select class="select2" name="resident_id" id="d_resident">
                            {{--Display List of Residents--}}
                        </select>
                    </div>
                    <div id="d_inputs" style="display:none">
                        <div class="form-group mb-2">
                            <label class="form-label">Select Family History *</label>
                            <select class="select2" name="family_history_id" id="d_family_history">
                                {{--Display List of Family History--}}
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Select Health Issue *</label>
                            <select class="select2" name="health_issue_id" id="d_health_issue">
                                {{--Display List of Health Issue--}}
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Guardian *</label>
                            <input class="form-control" type="text" name="guardian">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Address *</label>
                            <input class="form-control" type="text" name="address">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Contact *</label>
                            <input class="form-control" type="number" min="0" name="contact">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Relationship *</label>
                            <input class="form-control" type="text" name="relationship">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_health_profile btn_green"  onclick="c_store('.health_profile_form','.health_profile_dt', 'city_admin.health_profile.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_health_profile btn_navy_blue"  onclick="c_update('.health_profile_form','.health_profile_dt', 'city_admin.health_profile.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Health Profile--}}
@endif

@if(url()->current() === route('city_admin.event.index'))
    {{--Creating Event--}}
    <div class="modal fade" id="m_event" tabindex="-1" role="dialog" aria-labelledby="m_event_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_event_header">
            <h5 class="modal-title text-white" id="m_event_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="event_form" autocomplete="off">
                    <div class="form-group mb-3">
                        <label for="d_barangay" class="form-label">Select Barangay *</label>
                        <select class="select2" name="barangay_id" id="d_barangay" >
                          
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Event Name *</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Description *</label>
                        <textarea class="form-control" name="description" rows="5"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Event Location *</label>
                        <input class="form-control" type="text" name="location">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Organizer *</label>
                        <input class="form-control" type="text" name="organizer" >
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Contact *</label>
                        <input class="form-control" type="number" min="0" name="contact">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">DateTime Start *</label>
                        <input class="form-control" type="datetime-local" min="2021-10-01T00:00"  name="time_start">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">DateTime End *</label>
                        <input class="form-control" type="datetime-local" min="2021-10-01T00:00"  name="time_end">
                        <div class="form-text">Note* Please double check the schedule before encoding</div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_event btn_green"  onclick="c_store('.event_form','.event_dt', 'city_admin.event.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_event btn_navy_blue"  onclick="c_update('.event_form','.event_dt', 'city_admin.event.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Event--}}
@endif


{{--Creating Attendee--}}
    <div class="modal fade" id="m_attendee" tabindex="-1" role="dialog" aria-labelledby="m_attendee_label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" id="m_attendee_header">
            <h5 class="modal-title text-white" id="m_attendee_title">{{--Modal Title--}}</h5>
            <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
            </button>
            </div>

            <div class="modal-body py-5">
                <form class="attendee_form" autocomplete="off">
                    @csrf
                    <div class="form-group mb-2">
                        <label class="form-label">First Name *</label>
                        <input class="form-control" type="text" name="fname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Middle Name *</label>
                        <input class="form-control" type="text" name="mname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Last Name *</label>
                        <input class="form-control" type="text" name="lname">
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Gender *</label>
                        <select class="form-select" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Contact *</label>
                        <input class="form-control" type="number" min="0" name="contact">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_attendee btn_green"  onclick="storeAttendee()">Submit</button>
                <button type="button" class="btn float-end btn_update_attendee btn_navy_blue"  onclick="updateAttendee(event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
{{--End Creating Attendee--}}



