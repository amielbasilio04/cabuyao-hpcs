<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\HealthProfile;
use App\Http\Controllers\Controller;
use App\Models\Admin\FamilyHistory;
use App\Models\Admin\HealthIssue;

class HealthStatisticController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false

    }

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
                ->groupBy("barangays.id")
                ->get();
            }
            else
            {
                $health_profiles = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'health_issues.type')
                ->groupBy("barangays.id")
                ->get();
    
            }

          
            return $this->res(['results' => $health_profiles]);
        }

        // get only all active health issues 
        $health_issues = HealthIssue::has('health_profile')->get();


        return view('admin.health_statistic.index', compact('health_issues'));
    }


    public function family_history()
    {
        if(request()->ajax()) 
        {
           

            if(request()->search) 
            {
                $family_history_profile = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('family_histories', 'health_profiles.health_issue_id', 'family_histories.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'family_histories.type')
                ->where('family_histories.id', request()->search)
                ->groupBy("barangays.id")
                ->get();
            }
            else
            {
                $family_history_profile = DB::table('health_profiles')
                ->join('residents', 'health_profiles.resident_id', 'residents.id')
                ->join('barangays', 'residents.barangay_id', 'barangays.id')
                ->join('family_histories', 'health_profiles.health_issue_id', 'family_histories.id')
                ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'family_histories.type')
                ->groupBy("barangays.id")
                ->get();
    
            }

          
            return $this->res(['results' => $family_history_profile]);
        }

        // get only all family history issues 
        $family_histories_issue = FamilyHistory::has('health_profile')->get();


        return view('admin.health_statistic.familyhistory', compact('family_histories_issue'));
    }

    public function tabular()
    {
        
        $health_profiles = DB::table('health_profiles')
        ->join('residents', 'health_profiles.resident_id', 'residents.id')
        ->join('barangays', 'residents.barangay_id', 'barangays.id')
        ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
        ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'health_issues.type')
        ->groupBy("barangays.id")
        ->orderBy('total', 'DESC')
        ->get();


        $family_history_profile = DB::table('health_profiles')
        ->join('residents', 'health_profiles.resident_id', 'residents.id')
        ->join('barangays', 'residents.barangay_id', 'barangays.id')
        ->join('family_histories', 'health_profiles.family_history_id', 'family_histories.id')
        ->select(DB::raw('count(health_profiles.id) as total'), 'barangays.name', 'barangays.lat', 'barangays.long', 'family_histories.type')
        ->groupBy("barangays.id")
        ->get();


        return view('admin.health_statistic.tabular', compact('health_profiles', 'family_history_profile'));


    }

}
