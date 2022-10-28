<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use App\Models\Admin\HealthIssue;
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
            return DataTables::of(HealthProfile::with('resident.barangay', 'family_history', 'health_issue')->get())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $route_edit = route('city_admin.health_profile.edit', $row);

                    $btn = "<a href='$route_edit' class='btn btn-outline-navy-blue btn-sm'><i class='fas fa-edit'></i></a>";

                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                    onclick='c_destroy($row->id,`city_admin.health_profile.destroy`,`.health_profile_dt`)'><i class='fas fa-trash'></i></a> </div>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        
        return view('admin.health_profile.index');
    }

    public function create()
    {
        $barangays = Barangay::all();
        $family_histories = FamilyHistory::all();
        $health_issues = HealthIssue::all();

        return $this->res(['results' => compact('barangays','family_histories', 'health_issues')]);
    }

    public function edit(HealthProfile $health_profile)
    {
        $health_profile = HealthProfile::with('resident.barangay', 'family_history', 'health_issue')->where('id', $health_profile->id)->first();
        $family_histories = FamilyHistory::all();
        $health_issues = HealthIssue::all();

        return view('admin.health_profile.edit', compact('health_profile', 'family_histories', 'health_issues'));       
    }

    public function displayResidentByBarangay($id)
    {
        return $this->res(['results' => Resident::where('barangay_id', $id)->get()]);
    }

    public function store(HealthProfileStoreRequest $request)
    {
        // check if the resident has alreadyy a health profile

        $check = HealthProfile::where('resident_id', $request->resident_id)->first();

        if($check) {
            return $this->error('Selected resident has already an existing Health Profile', 422);
        }

        HealthProfile::create($request->validated());

        return $this->res(['message' => "Resident's Health Profile Added Successfully"]);
    }

    public function update(HealthProfileUpdateRequest $request , HealthProfile $health_profile)
    {
        $health_profile->update($request->validated());

        return back()->with('message', "Resident's Health Profile Updated Successfully" );

    }

    public function destroy(HealthProfile $health_profile)
    {
        $health_profile->delete();

        return $this->res(['message' => "Resident's Health Profile Deleted Successfully"]);
    }
}
