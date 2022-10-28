<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Event;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use App\Models\Admin\HealthIssue;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\HealthProfile;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }
    public function index()
    {
        // DB::statement("SET SQL_MODE=''"); // set the strict to false
        $activities = Activity::latest()->take(5)->get();
        $barangay_admins = User::where('role_id', 2)->get();
        $total_residents = Resident::count();
        $total_health_profiles = HealthProfile::count();
        $total_barangays = Barangay::count();
        $total_barangay_admins = $barangay_admins->count();
        $total_health_issues = HealthIssue::count();
        $total_events = Event::where('is_approved',1)->count();
        $total_pending_events = Event::where('is_approved', 0)->count();
        $total_canceled_events = Event::where('is_approved', 2)->count();

        $barangays = $this->getTotalResidentsByBarangay()[0];
        $residents = $this->getTotalResidentsByBarangay()[1];

        $hp_barangays = $this->getTotalHealthIssuesByBarangay()[0];
        $hp_total_health_issues = $this->getTotalHealthIssuesByBarangay()[1];

        return view('admin.dashboard.index', compact(
                                                    'total_residents',
                                                    'total_health_profiles',
                                                    'total_barangays',
                                                    'total_barangay_admins',
                                                    'total_health_issues',
                                                    'total_events',
                                                    'total_pending_events',
                                                    'total_canceled_events',
                                                    'barangay_admins',
                                                    'barangays',
                                                    'residents',
                                                    'hp_barangays',
                                                    'hp_total_health_issues',
                                                    'activities'
                                                ));


        return view('admin.dashboard.index');
    }

    public function getTotalResidentsByBarangay()
    {
        $barangays = [];
        $total_residents = [];

        foreach(Barangay::with('resident')->get() as $barangay) {
                $barangays[] = $barangay->name;
                $total_residents[] = $barangay->resident()->count();
        }

        return [$barangays, $total_residents];
    }

    public function getTotalHealthIssuesByBarangay()
    {
        $barangays = [];
        $total_health_issues = [];

        $health_profiles = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name')
                ->groupBy("barangays.id")
                ->get();

                foreach($health_profiles as $hp) {
                    $barangays[] = $hp->name;
                    $total_health_issues[] = $hp->total;
                }

        return [$barangays, $total_health_issues];
    }
    
}
