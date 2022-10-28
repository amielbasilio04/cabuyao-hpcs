// Globals
let pond;
const token = $('meta[name="csrf-token"]').attr("content");
const baseUrl = window.location.origin;
const health_event = "";
// let txtarea;
// let week_id;

$(() => {
    //==================================================
    // Router

    //Activity Logs
    if (window.location.href === route("brgy_admin.activity.index")) {
        const activitylog_data = [
            { data: "id" },
            { data: "description" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
        ];

        c_index(
            $(".activitylog_dt"),
            route("brgy_admin.activity.index"),
            activitylog_data
        );
    }

    // Residents
    if (window.location.href === route("brgy_admin.resident.index")) {
        const resident_data = [
            { data: "id" },
            { data: "fname" },
            { data: "mname" },
            { data: "lname" },
            { data: "gender" },
            { data: "address" },
            { data: "barangay" },
            { data: "contact" },
            { data: "email" },
            {
                data: "created_at",
                render(data) {
                    return formatDate(data.date, "full");
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".resident_dt"),
            route("brgy_admin.resident.index"),
            resident_data
        );
    }

    // Health Profile
    if (window.location.href === route("brgy_admin.health_profile.index")) {
        const health_profile_data = [
            { data: "id" },
            { data: "fname" },
            { data: "mname" },
            { data: "lname" },
            { data: "name" },
            {
                data: "family_history",
                render(data) {
                    return data ?? "";
                },
            },
            { data: "health_issue" },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index(
            $(".health_profile_dt"),
            route("brgy_admin.health_profile.index"),
            health_profile_data
        );

        // initialize select
        $("#d_resident").select2({
            dropdownParent: $("#m_health_profile"),
        });
        $("#d_family_history").select2({
            dropdownParent: $("#m_health_profile"),
        });
        $("#d_health_issue").select2({
            dropdownParent: $("#m_health_profile"),
        });
    }

    // Events
    if (window.location.href === route("brgy_admin.event.index")) {
        const event_data = [
            { data: "id" },
            { data: "barangay.name" },
            { data: "name" },
            {
                data: "time_start",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            {
                data: "time_end",
                render(data) {
                    return formatDate(data, "datetime");
                },
            },
            {
                data: "is_approved",
                render(data) {
                    return isApproved(data);
                },
            },
            { data: "actions", orderable: false, searchable: false },
        ];
        c_index($(".event_dt"), route("brgy_admin.event.index"), event_data);

        // initialize select
        $("#d_barangay").select2({
            dropdownParent: $("#m_event"),
        });
    }
});
//==================================================
// custom functions

// Health Profile
async function createHealthProfile() {
    $("#m_health_profile").modal("show");
    $(".health_profile_form")[0].reset(); // clear input field
    $("#m_health_profile_title").html(
        `Add Health Profile <i class="fas fa-plus-circle ms-2"></i> `
    );
    $(".modal-header").removeClass("bg_navy_blue").addClass("bg_green");
    $(".btn_add_health_profile").css("display", "block"); // add button
    $(".btn_update_health_profile").css("display", "none"); // update button

    // query

    const res = await axios.get(route("brgy_admin.health_profile.create"));

    $("#d_resident").html(
        displayDataToSelectInputField(res.data.results.residents, "fullname")
    );
    $("#d_family_history").html(
        displayDataToSelectInputField(res.data.results.family_histories, "type")
    );
    $("#d_health_issue").html(
        displayDataToSelectInputField(res.data.results.health_issues, "type")
    );
}

function displayHealthProfileInputField(resident) {
    if (resident.value) {
        $("#d_inputs").css("display", "block");
    } else {
        $("#d_inputs").css("display", "none");
    }
}

// End health Profile

// Attendee

function createAttendee(event_id) {
    event_data = event_id; // append event_id to var event_data
    $("#m_attendee").modal("show"); // show modal dialog
    $(".attendee_form")[0].reset(); // clear input field
    $("#m_attendee_title").html(
        ` Add Attendee <i class="fas fa-plus-circle ms-2"></i> `
    );
    $(".modal-header").removeClass("bg_navy_blue").addClass("bg_green");
    $(".btn_add_attendee").css("display", "block"); // add button
    $(".btn_update_attendee").css("display", "none"); // update button
}

async function storeAttendee() {
    // Validation
    let bool;

    $(".attendee_form *")
        .filter(":input")
        .each(function () {
            // loop through each element & apply sanitation
            if (isNotEmpty($(this))) {
                bool = true;
            }
        });

    if (bool) {
        // convert the first form in the parameter into a form data object
        const form_data = new FormData($(".attendee_form")[0]);
        form_data.append("event_id", event_data);

        try {
            // request
            const res = await axios.post(
                route("brgy_admin.attendee.store"),
                form_data
            );

            const attendee = res.data.result; // the newly added attendee

            success("Attendee Added Successfully");
            $(".attendee_form")[0].reset(); // clear input field

            let output = `<tr id="row_attendee-${attendee.id}">
                            <td>${attendee.fname} ${attendee.lname}</td>
                            <td>${attendee.gender}</td>
                            <td>${attendee.contact}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn_green text-white rounded" href="javascript:void(0)" onclick='c_edit("#m_attendee", ".attendee_form :input", ["#m_attendee_title", "Edit Attendee"],[".btn_add_attendee",".btn_update_attendee"],${JSON.stringify(
                                        attendee
                                    )})'><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger rounded ms-1" href="#" onclick="removeAttendee(${
                                        attendee.id
                                    })"> <i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                          </tr>`;

            $("#d_attendees").append(output); // append the newly created attendee to the attendee table
        } catch (e) {
            const responses = e.response.data.errors;
            if (responses) {
                const errors = Object.values(responses);
                errors.forEach((e) => {
                    toastDanger(e);
                });
            } else {
                error(e.response.data.message);
            }
        }
    }
}

async function updateAttendee(event) {
    // convert the first form in the parameter into a form data object
    const form_data = new FormData($(".attendee_form")[0]);
    form_data.append("_method", "PUT");
    const model_id = event.target.getAttribute("data-id");

    try {
        // request
        const res = await axios.post(
            `${route("brgy_admin.attendee.update", model_id)}`,
            form_data
        ); // fake update request

        const attendee = res.data.result; // the newly updated attendee
        success("Attendee Updated Successfully");
        let output = `<td> ${attendee.fname} ${attendee.lname} </td>
                      <td> ${attendee.gender} </td>
                      <td> ${attendee.contact} </td>
                      <td> 
                        <div class="btn-group">
                        <a class="btn btn-sm btn_green text-white rounded" href="javascript:void(0)" onclick='c_edit("#m_attendee", ".attendee_form :input", ["#m_attendee_title", "Edit Attendee"],[".btn_add_attendee",".btn_update_attendee"],${JSON.stringify(
                            attendee
                        )})'><i class="fas fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger rounded ms-1" href="#" onclick="removeAttendee(${
                            attendee.id
                        })"> <i class="fas fa-trash"></i></a>
                        </div>
                      </td>`;

        $("#row_attendee-" + model_id).html(output); // update the content of attendee row
    } catch (e) {
        const responses = e.response.data.errors;
        if (responses) {
            const errors = Object.values(responses);
            errors.forEach((e) => {
                toastDanger(e);
            });
        } else {
            error(e.response.data.message);
        }
    }
}
async function removeAttendee(attendee) {
    const res = await confirm();

    if (res.isConfirmed) {
        try {
            const res = await axios.delete(
                route("brgy_admin.attendee.destroy", attendee)
            );
            $("#row_attendee-" + attendee).remove();
            success(res.data.message);
        } catch (e) {
            log(e);
            error(e.response.data.message);
        }
    }
}

// End Attendee

//==================================================
// crud function

async function c_index(dt, route, column) {
    //axios.get("/admin/booking").then((res) => log(res));

    $(dt).DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        autoWidth: false,
        ajax: route,
        columns: column,
        dom: "Bfrtip",
        // buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5", "print"],
        buttons: {
            dom: {
                button: {
                    className: "btn btn_green btn-sm btn-rounded mb-2",
                },
            },
            buttons: [
                "copyHtml5",
                "excelHtml5",
                "csvHtml5",
                "pdfHtml5",
                "print",
            ],
            position: "bottom",
        },
    });
}

// activate - deactivate status
function crud_activate_deactivate(id, route_name, value, dt, msg) {
    Swal.fire({
        title: `Do you want to ${msg}?`,
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `Yes, ${value} it!`,
    }).then((result) => {
        if (result.isConfirmed) {
            axios
                .put(route(route_name, id), { option: value })
                .then((res) => {
                    $(dt).DataTable().draw();
                    success(`${value} successfully`);
                })
                .catch((err) => error(err));
        }
    });
}

// crud create
function toggle_modal(modal, form, modal_title, buttons, opt = "") {
    // if there is an optional parameter then execute the query
    // opt [route_name, element target (where to append the data)]
    if (opt) {
        axios.get(route(opt.rname)).then((res) => {
            let data = `<option></option>`;
            res.data.results.forEach((patient) => {
                data += `<option value='${patient.id}'>${patient.fname}  ${patient.lname}</option>`;
            });
            $(opt.target).html(data); // append the patient data []
        });
    }

    $(modal).modal("show"); // show modal dialog
    $(form)[0].reset(); // clear input field
    $(modal_title[0]).html(
        `${modal_title[1]} <i class="fas fa-plus-circle ms-2"></i> `
    );
    $(".modal-header").removeClass("bg_navy_blue").addClass("bg_green");
    $(buttons[0]).css("display", "block"); // add button
    $(buttons[1]).css("display", "none"); // update button
}

async function c_store(form, dt, route_name) {
    // Validation
    let bool;

    $(`${form} *`)
        .filter(":input")
        .each(function () {
            // loop through each element & apply sanitation
            if (isNotEmpty($(this))) {
                bool = true;
            }
        });

    if (bool) {
        // convert the first form in the parameter into a form data object
        const form_data = new FormData($(form)[0]);

        try {
            // request
            const res = await axios.post(route(route_name), form_data);
            success(res.data.message);
            pond ? pond.removeFiles() : "";
            $(form)[0].reset(); // clear input field
            $(dt).DataTable().draw(); // update dt
        } catch (e) {
            const responses = e.response.data.errors;
            if (responses) {
                const errors = Object.values(responses);
                errors.forEach((e) => {
                    toastDanger(e);
                });
            } else {
                error(e.response.data.message);
            }
        }
    }
}

// crud edit
function c_edit(modal, form, modal_title, buttons, model, opt = "") {
    if (opt) {
        // if there is an optional parameter then execute the query
        // opt [route_name, element target (where to append the data)]
        if (opt) {
            axios.get(route(opt.rname)).then((res) => {
                let data = `<option value='${model.category_id}'>${model.category} (Current)</option>`;
                res.data.results.forEach((category) => {
                    data += `<option value='${category.id}'>${category.category}</option>`;
                });
                $(opt.target).html(data); // append the category data []
            });
        }
    }

    // continue
    $(modal).modal("show");
    $(".yes").attr("checked", false); // clear first
    $(".no").attr("checked", false);
    $(".modal-header")
        .removeClass("bg_green")
        .addClass("bg_navy_blue text-white");
    $(modal_title[0]).html(
        `${modal_title[1]} <i class="fas fa-edit ms-1"></i> `
    );
    $(buttons[0]).css("display", "none"); // add button
    $(buttons[1]).css("display", "block").attr("data-id", model.id); // show update button and append a model id to it

    const key_val = Object.entries(model); // ex output (6) [ 0:{0:id, 1:test}, 1:{0:id, 1:test2}]

    const form_field = $(form); // get all input field inside a form

    // loop each input fields and find its match input name to the model instance
    form_field.each((key, val) => {
        key_val.forEach((k) => {
            if (
                val.type == "text" ||
                val.type == "number" ||
                val.type == "select-one" ||
                val.type == "radio" ||
                val.type == "date" ||
                val.type == "time" ||
                val.type == "email"
            ) {
                // check if the input type name is equal to the database key ex input name='email' db column name = email
                if (k[0] == val.name) {
                    //check if its not a radio button
                    // append a value
                    if (val.type !== "radio") {
                        val.value = k[1];
                    } else {
                        // if the value of the radio buttons are set to true . assign checked prop to the 'yes' radio btn
                        if (k[1] == 1) {
                            $(".yes").attr("checked", true);
                        } else {
                            // else assign checked prop to the 'no' radio btn
                            $(".no").attr("checked", true);
                        }
                    }
                }
            }
        });
    });
}

// crud update
async function c_update(form, dt, route_name, event) {
    // convert the first form in the parameter into a form data object
    const form_data = new FormData($(form)[0]);
    form_data.append("_method", "PUT");
    const model_id = event.target.getAttribute("data-id");

    try {
        // request
        const res = await axios.post(
            `${route(route_name, model_id)}`,
            form_data
        ); // fake update request

        success(res.data.message);
        //pond.removeFiles() ?? "";
        $(dt).DataTable().draw(); // update dt
    } catch (e) {
        const responses = e.response.data.errors;
        if (responses) {
            const errors = Object.values(responses);
            errors.forEach((e) => {
                toastDanger(e);
            });
        } else {
            error(e.response.data.message);
        }
    }
}

// crud destroy
async function c_destroy(id, routename, dt) {
    const result = await confirm();
    if (result.isConfirmed) {
        try {
            const res = await axios.delete(route(routename, id));
            success(res.data.message);
            $(dt).DataTable().draw(); // update dt
        } catch (e) {
            const responses = e.response.data.errors;
            if (responses) {
                const errors = Object.values(responses);
                errors.forEach((e) => {
                    toastDanger(e);
                });
            } else {
                error(e.response.data.message);
            }
        }
    }
}
