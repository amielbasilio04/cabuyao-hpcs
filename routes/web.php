<?php

// Facades

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Shared Restful Controllers
use App\Http\Controllers\All\TmpImageUploadController;

// City Admin Restful Controllers
use App\Http\Controllers\Admin\{UserController,
    DashboardController,
    ProfileController as AdminProfileController,
    ActivityLogController,
    AttendeeController,
    BarangayAdminController,
    BarangayController,
    CalendarController,
    EventController,
    FamilyHistoryController,
    HealthIssueController,
    HealthProfileController,
    HealthStatisticController,
    ResidentController
};



// USer - Barangay Admin Restful Controllers
use App\Http\Controllers\User\{DashboardController as UserDashboardController,
    EventController as UserEventController,
    HealthProfileController as UserHealthProfileController,
    HealthStatisticController as UserHealthStatisticController,
    ProfileController,
    ResidentController as UserResidentController,
    AttendeeController as UserAttendeeController,
    CalendarController as UserCalendarController,
    ActivityLogController as UserActivityLogController
};

Route::group(['middleware' => 'prevent-back-history'],function(){
	


Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/test', function () {
    return view('test');
});

// City Admin
Route::group(['middleware' => ['auth', 'city_admin'], 'prefix' => 'city_admin', 'as' => 'city_admin.'],function() {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('barangay', BarangayController::class);
    Route::resource('barangay_admin', BarangayAdminController::class)->parameter('barangay_admin', 'user');
    Route::resource('resident', ResidentController::class);
    Route::resource('family_history', FamilyHistoryController::class);
    Route::resource('health_issue', HealthIssueController::class);
    Route::get('healh_profile/get_resident/{id}', [HealthProfileController::class,'displayResidentByBarangay'])->name('health_profile.displayResidentByBarangay');
    Route::resource('health_profile', HealthProfileController::class);
    Route::get('health_statistic/health-issue', [HealthStatisticController::class, 'index'])->name('health_statistic.index');
    Route::get('health_statistic/family-history', [HealthStatisticController::class, 'family_history'])->name('health_statistic.family_history');
    Route::get('health_statistic/tabular-statistic', [HealthStatisticController::class, 'tabular'])->name('health_statistic.tabular');
    Route::resource('event', EventController::class);
    Route::resource('calendar', CalendarController::class)->parameter('calendar', 'event');
    Route::resource('attendee', AttendeeController::class);



    Route::resource('user', UserController::class);
    Route::resource('activity', ActivityLogController::class);
    Route::resource('profile', AdminProfileController::class)->parameter('profile', 'user');

});
// Auth
Route::group(['middleware' => ['auth']],function() {
  // TMP FILE UPLOAD
  Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);
  Route::post('tmp_upload/content', [TmpImageUploadController::class, 'faqImageUpload'])->name('tmpupload.faqImageUpload');
  Route::resource('tmp_upload', TmpImageUploadController::class);

});

// Barangay Admin
Route::group(['middleware' => ['auth'], 'prefix' => 'brgy_admin', 'as' => 'brgy_admin.'],function() {
        Route::resource('dashboard', UserDashboardController::class);
        Route::resource('activity', UserActivityLogController::class);
        Route::resource('profile', ProfileController::class)->parameter('profile', 'user');
        Route::resource('resident', UserResidentController::class);
        Route::resource('health_profile', UserHealthProfileController::class);
        Route::resource('health_statistic', UserHealthStatisticController::class);
        Route::resource('event', UserEventController::class);
        Route::resource('calendar', UserCalendarController::class)->parameter('calendar', 'event');
        Route::resource('attendee', UserAttendeeController::class);

});

});


Auth::routes(['register' => false]);

