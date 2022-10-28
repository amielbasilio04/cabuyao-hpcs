<?php

namespace App\Http\Controllers\User;

use App\Models\Like;
use App\Models\Post;
use App\Models\Todo;
use App\Pivot\DateTime;
use App\Models\Admin\Event;
use Illuminate\Http\Request;
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
        $activities = Activity::where('causer_type', 'App\Models\User')->where('causer_id', auth()->id())->latest()->take(5)->get();
        $total_residents = Resident::where('barangay_id', auth()->user()->barangay_id)->count();
        $total_health_profiles = Resident::has('health_profile')->where('barangay_id', auth()->user()->barangay_id)->count();
        $total_barangays = Barangay::count();
        $total_health_issues = HealthIssue::count();
        $total_events = Event::where('is_approved',1)->where('barangay_id',  auth()->user()->barangay_id )->count();
        $total_pending_events = Event::where('is_approved', 0)->where('barangay_id',  auth()->user()->barangay_id )->count();
        $total_canceled_events = Event::where('is_approved', 2)->where('barangay_id',  auth()->user()->barangay_id )->count();
        $my_residents = Resident::where('barangay_id', auth()->user()->barangay_id)->get();
        $barangays = $this->getTotalResidentsByBarangay()[0];
        $residents = $this->getTotalResidentsByBarangay()[1];
        $hp_barangays = $this->getTotalHealthIssuesByBarangay()[0];
        $hp_total_health_issues = $this->getTotalHealthIssuesByBarangay()[1];

        return view('user.dashboard.index', compact(
                                                    'total_residents',
                                                    'total_health_profiles',
                                                    'total_barangays',
                                                    'total_health_issues',
                                                    'total_events',
                                                    'total_pending_events',
                                                    'total_canceled_events',
                                                    'barangays',
                                                    'residents',
                                                    'hp_barangays',
                                                    'hp_total_health_issues',
                                                    'my_residents',
                                                    'activities'
                                                ));

    }

    public function getTotalResidentsByBarangay()
    {
        $barangays = [];
        $total_residents = [];

        foreach(Barangay::with('resident')->whereId(auth()->user()->barangay_id)->get() as $barangay) {
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
                ->where('residents.barangay_id', auth()->user()->barangay_id)
                ->groupBy("barangays.id")
                ->get();

                foreach($health_profiles as $hp) {
                    $barangays[] = $hp->name;
                    $total_health_issues[] = $hp->total;
                }

        return [$barangays, $total_health_issues];
    }
}
