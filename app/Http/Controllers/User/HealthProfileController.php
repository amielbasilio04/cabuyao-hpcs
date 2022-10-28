<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\Resident;
use App\Models\Admin\HealthIssue;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\FamilyHistory;
use App\Models\Admin\HealthProfile;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Shared\HealthProfile\HealthProfileStoreRequest;
use App\Http\Requests\Shared\HealthProfile\HealthProfileUpdateRequest;

class HealthProfileController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            // $my_residents_health_profile = HealthProfile::with(['family_history', 'health_issue', 'resident.barangay' => fn($q) => $q->where('barangay.id' , auth()->user()->barangay_id)])->get();
            $my_residents_health_profile =  DB::table('health_profiles')
            ->join('residents', 'health_profiles.resident_id', 'residents.id')
            ->join('barangays', 'residents.barangay_id', 'barangays.id')
            ->join('health_issues', 'health_profiles.health_issue_id', 'health_issues.id')
            ->join('family_histories', 'health_profiles.family_history_id', 'family_histories.id')
            ->select('health_profiles.id','barangays.name','residents.fname', 'residents.mname', 'residents.lname', DB::raw('family_histories.type as family_history, health_issues.type as health_issue '))
            ->where('residents.barangay_id', auth()->user()->barangay_id)
            ->get();

            return DataTables::of($my_residents_health_profile)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    $route_edit = route('brgy_admin.health_profile.edit', $new_row['id']);

                    $btn = "<a href='$route_edit' class='btn btn-outline-navy-blue btn-sm'><i class='fas fa-edit'></i></a>";

                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                    onclick='c_destroy($new_row[id],`brgy_admin.health_profile.destroy`,`.health_profile_dt`)'><i class='fas fa-trash'></i></a> </div>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        
        return view('user.health_profile.index');
    }

    public function create()
    {
        $residents = Resident::where('barangay_id', auth()->user()->barangay_id)->get();
        $family_histories = FamilyHistory::all();
        $health_issues = HealthIssue::all();

        return $this->res(['results' => compact('residents','family_histories', 'health_issues')]);
    }

    public function store(HealthProfileStoreRequest $request)
    {
        // check if the resident has alreadyy a health profile

        $check = HealthProfile::where('resident_id', $request->resident_id)->first();

        if($check) {
            return $this->error('Selected resident has already an existing Health Profile', 422);
        }

       $health_profile =  HealthProfile::create($request->validated());

       $this->log_activity($health_profile, 'added', 'Health Profile', $health_profile->resident->full_name );


        return $this->res(['message' => "My Resident's Health Profile Added Successfully"]);
    }

    public function edit(HealthProfile $health_profile)
    {
        $health_profile = HealthProfile::with('resident.barangay', 'family_history', 'health_issue')->where('id', $health_profile->id)->first();
        $family_histories = FamilyHistory::all();
        $health_issues = HealthIssue::all();

        return view('user.health_profile.edit', compact('health_profile', 'family_histories', 'health_issues'));       
    }


    public function update(HealthProfileUpdateRequest $request , HealthProfile $health_profile)
    {
        $health_profile->update($request->validated());

        $this->log_activity($health_profile, 'updated', 'Health Profile', $health_profile->resident->full_name );

        return back()->with('message', "My Resident's Health Profile Updated Successfully" );

    }

    public function destroy(HealthProfile $health_profile)
    {
        $this->log_activity($health_profile, 'deleted', 'Health Profile', $health_profile->resident->full_name );

        $health_profile->delete();

        return $this->res(['message' => "My Resident's Health Profile Deleted Successfully"]);
    }

}
