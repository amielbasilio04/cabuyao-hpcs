
@if(url()->current() === route('brgy_admin.resident.index'))
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
                            <label class="form-label">Contact *</label>
                            <input class="form-control" type="number" min="0" name="contact">
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Email *</label>
                            <input class="form-control" type="email" name="email">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn float-end btn_add_resident btn_green"  onclick="c_store('.resident_form','.resident_dt', 'brgy_admin.resident.store')">Submit</button>
                    <button type="button" class="btn float-end btn_update_resident btn_navy_blue"  onclick="c_update('.resident_form','.resident_dt', 'brgy_admin.resident.update', event)">Update</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    {{--End Creating Resident--}}
@endif


@if(url()->current() === route('brgy_admin.health_profile.index'))
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
                        <label class="form-label">Select Resident *</label>
                        <select class="select2" name="resident_id" id="d_resident" onchange="displayHealthProfileInputField(this)">
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
                <button type="button" class="btn float-end btn_add_health_profile btn_green"  onclick="c_store('.health_profile_form','.health_profile_dt', 'brgy_admin.health_profile.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_health_profile btn_navy_blue"  onclick="c_update('.health_profile_form','.health_profile_dt', 'brgy_admin.health_profile.update', event)">Update</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    {{--End Creating Health Profile--}}
@endif


@if(url()->current() === route('brgy_admin.event.index'))
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
                        <input class="form-control" type="datetime-local" min="2021-10-01T00:00" max="2022-01-01T00:00" name="time_start">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">DateTime End *</label>
                        <input class="form-control" type="datetime-local" min="2021-10-01T00:00" max="2022-01-01T00:00" name="time_end">
                        <div class="form-text">Note* Please double check the schedule before encoding</div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn float-end btn_add_event btn_green"  onclick="c_store('.event_form','.event_dt', 'brgy_admin.event.store')">Submit</button>
                <button type="button" class="btn float-end btn_update_event btn_navy_blue"  onclick="c_update('.event_form','.event_dt', 'brgy_admin.event.update', event)">Update</button>
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



