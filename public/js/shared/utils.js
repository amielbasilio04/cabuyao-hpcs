//===================================================================================
// Global Fn()

function initiateFilePond(element) {
    // FOR TMP FILE UPLOAD

    // Get a reference to the file input element
    const images = document.querySelector(element);

    // plugins
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    // Create a FilePond instance
    pond = FilePond.create(images, {
        acceptedFileTypes: [
            "image/png",
            "image/jpeg",
            "image/jpg",
            "image/webp",
        ],
        maxFileSize: "2MB",
        storeAsFile: true,
        server: {
            url: `${baseUrl}/tmp_upload`,
            headers: {
                "X-CSRF-TOKEN": `${token}`,
            },
            revert: "/revert",
        },
    });
}

function displayDataToSelectInputField(values, column) {
    let output = `<option></option>`;
    if (values.length > 0) {
        values.forEach((value) => {
            if (column == "type") {
                output += `<option value='${value.id}'> ${value.type} </option>`;
            }
            if (column == "name") {
                output += `<option value='${value.id}'> ${value.name} </option>`;
            }
            if (column == "fullname") {
                output += `<option value='${value.id}'> ${value.fname} ${value.lname} </option>`;
            }
        });
    } else {
        output = `<option>No Data Found</option>`;
    }

    return output;
}

function isNotEmpty(input) {
    if (input.val() == "") {
        input.addClass("is-invalid");
        return false;
    } else {
        input.removeClass("is-invalid");
        return true;
    }
}

function handleNullAvatar(img) {
    if (img) {
        return `<img class='img-thumbnail' src='${img}' width='75'>`;
    } else {
        return `<img class='img-thumbnail' src='/img/noimg.svg' width='75'>`;
    }
}

function handleNullImage(img) {
    if (img) {
        return `<img class='img-thumbnail' src='${img}' width='75'>`;
    } else {
        return `<img class='img-thumbnail' src='/img/noimg.png' width='75'>`;
    }
}

function log(response) {
    return console.log(response);
}

function convert_time(value) {
    let converted_time = new Date(
        "1970-01-01T" + value + "Z"
    ).toLocaleTimeString(
        {},
        { timeZone: "UTC", hour12: true, hour: "numeric", minute: "numeric" }
    );

    return converted_time;
}

function convertToDataTable(dt, opt = "") {
    if (opt) {
        $(dt).dataTable({
            lengthChange: false,
            dom: "Bfrtip",
            buttons: {
                dom: {
                    button: {
                        className: "btn btn_navy_blue btn-sm btn-rounded mb-2",
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
    } else {
        $(dt).dataTable();
    }
}

function calDateAgo(dString = null) {
    //var dString = "2021-04-1 12:00:00";

    var d1 = new Date(dString);
    var d2 = new Date();
    var t2 = d2.getTime();
    var t1 = d1.getTime();
    var d1Y = d1.getFullYear();
    var d2Y = d2.getFullYear();
    var d1M = d1.getMonth();
    var d2M = d2.getMonth();

    var time_obj = {};
    time_obj.year = d2.getFullYear() - d1.getFullYear();
    time_obj.month = d2M + 12 * d2Y - (d1M + 12 * d1Y);
    time_obj.week = parseInt((t2 - t1) / (24 * 3600 * 1000 * 7));
    time_obj.day = parseInt((t2 - t1) / (24 * 3600 * 1000));
    time_obj.hour = parseInt((t2 - t1) / (3600 * 1000));
    time_obj.minute = parseInt((t2 - t1) / (60 * 1000));
    time_obj.second = parseInt((t2 - t1) / 1000);

    for (const obj_key in time_obj) {
        if (time_obj[obj_key] == 0) {
            delete time_obj[obj_key];
        }
    }
    var ago_text = "just now";

    if (typeof Object.keys(time_obj)[0] != "undefined") {
        var time_key = Object.keys(time_obj)[0];
        var time_val = time_obj[Object.keys(time_obj)[0]];
        time_key += time_val > 1 ? "s" : "";
        ago_text = time_val + " " + time_key + " ago";
    }

    return ago_text;
}

function convert_date(value) {
    let date = new Date(value);

    return date.toDateString();
}

function formatDate(date, opt) {
    if (opt == "full") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleDateString();
    }

    if (opt == "datetime") {
        const formatted_date = new Date(date);
        return formatted_date.toLocaleString();
    }

    if (opt == "dateString") {
        const formatted_date = new Date(date);
        return formatted_date.toDateString();
    }
}

function formatTime(time, opt = "12") {
    const timeString12hr = new Date(
        "1970-01-01T" + time + "Z"
    ).toLocaleTimeString("en-US", {
        timeZone: "UTC",
        hour12: true,
        hour: "numeric",
        minute: "numeric",
    });

    if (opt == "12") {
        return timeString12hr.toLocaleString([], { hour12: true });
    }
}

// print  0 or 1 to (Pending, Approved , Decline)
function isApproved(data) {
    if (data === 0) {
        return `<span class='badge bg_navy_blue p-2 text-uppercase'>Pending</span>`;
    } else if (data === 1) {
        return `<span class='badge bg_green text-white p-2 text-uppercase'>Approved</span>`;
    } else {
        return `<span class='badge bg-danger p-2 text-uppercase'>Canceled</span>`;
    }
}

// print  0 or 1 to (Pending, Approved , Decline)
function isActivated(data) {
    if (data === 0) {
        return `<span class='badge bg_navy_blue p-2 text-uppercase'>Deactivated</span>`;
    } else {
        return `<span class='badge bg_green p-2 text-uppercase'>Activated</span>`;
    }
}

function isScheduleDone(data) {
    return data == 0
        ? `<span class='badge default_bg text-white p-2 text-uppercase'>Active</span>`
        : `<span class='badge default_bg text-white p-2 text-uppercase'>Done</span>`;
}

function isTaskDone(data, opt = "") {
    if (opt == "") {
        return data == 0
            ? `<span class='badge default_bg text-white p-2 text-uppercase'>Pending</span>`
            : `<span class='badge default_bg text-white p-2 text-uppercase'>Done ✓ </span>`;
    } else {
        return opt.status === 0
            ? `<span class='txt_secondary'>${data} ✓ </span>`
            : `<span class='txt_secondary text-decoration-line-through'>${data} ✓ </span>`;
    }
}

function getReminder(data) {
    if (data == "daily") {
        return `<span class='badge default_bg text-white p-2 text-uppercase'>Daily</span>`;
    } else if (data == "other_day") {
        return `<span class='badge default_bg text-white p-2 text-uppercase'>Every Other Day</span>`;
    } else {
        return `<span class='badge default_bg text-white p-2 text-uppercase'>Weekly</span>`;
    }
}

function isOpen(data) {
    if (data === 0) {
        return `<span class='badge bg-info p-2 text-uppercase'>Open</span>`;
    } else if (data === 1) {
        return `<span class='badge bg-primary p-2 text-uppercase'>Reserved</span>`;
    } else {
        return `<span class='badge bg-danger p-2 text-uppercase'>Declined</span>`;
    }
}

function isReserved(patient) {
    if (patient) {
        return `<span class='badge default_bg p-2 text-uppercase'>Reserved</span>`;
    } else {
        return `<span class='badge default_bg p-2 text-uppercase'>Open</span>`;
    }
}

// show image
$(document).on("click", "#show_img", function () {
    let image = $(this).attr("src");
    Swal.fire({
        title: "",
        imageWidth: "100%",
        imageHeight: "100%",
        padding: "3em",
        imageUrl: `${image}`,
        backdrop: `
          rgba(0,0,123,0.4)
          left top
          no-repeat
        `,
    });
});

//==========================================================================================

// GLOBAL ALERTS
function success(msg) {
    Swal.fire({
        icon: "success",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

function error(msg) {
    Swal.fire({
        icon: "error",
        title: `${msg}`,
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

function confirm(
    title = "Are you sure?",
    text = `You won't be able to revert this!`,
    confirmTxt = `Yes, delete it!`,
    icon = "warning"
) {
    return Swal.fire({
        title,
        text,
        icon,
        showCancelButton: true,
        confirmButtonColor: "#4085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: confirmTxt,
    }).then((result) => result);
}

function toastSuccess(message) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["success"](`${message} Successfully`, "Success");
}

function toastDanger(message = "Sorry, there was a problem.") {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["error"](`${message}`, "Error");
}

function toastWarning(message = "Please fill up all required fields ") {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-bottom-right",
        preventDuplicates: true,
        onclick: null,
        showDuration: "400",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    Command: toastr["warning"](`${message}`, "Warning");
}
