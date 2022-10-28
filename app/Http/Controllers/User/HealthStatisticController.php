<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\HealthIssue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HealthStatisticController extends Controller
{
    public function index()
    {
        if(request()->ajax()) 
        {
            DB::statement("SET SQL_MODE=''"); // set the strict to false

            if(request()->search) 
            {
                $health_profiles = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'health_issues.type')
                ->where('health_issues.id', request()->search)
                ->where('barangays.id', auth()->user()->barangay_id)
                // ->groupBy("barangays.id")
                ->get();
            }
            else
            {
                $health_profiles = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'health_issues.type')
                ->where('barangays.id', auth()->user()->barangay_id)
                // ->groupBy("barangays.id")
                ->get();
    
            }

          
            return $this->res(['results' => $health_profiles]);
        }

        // get only all active health issues 
        $health_issues = HealthIssue::has('health_profile')->get();


        return view('user.health_statistic.index', compact('health_issues'));
    }
}
