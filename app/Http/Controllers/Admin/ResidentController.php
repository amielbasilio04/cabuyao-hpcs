<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Resources\Admin\Resident\ResidentResource;
use App\Http\Requests\Shared\Resident\ResidentStoreRequest;
use App\Http\Requests\Shared\Resident\ResidentUpdateRequest;

class ResidentController extends Controller
{
    
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(ResidentResource::collection(Resident::all()))
            ->addIndexColumn()
            ->addColumn('actions', function($row) {

             $new_row = collect($row);

             $btn = "<div class='btn-group'>
                        <a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='editResident(`#m_resident`, `.resident_form :input`, [`#m_resident_title`, `Edit Resident`], [`.btn_add_resident`, `.btn_update_resident`], $new_row, {rname:`city_admin.resident.create`, target:`#d_barangay`})'><i class='fas fa-edit'></i></a>";
                        
             $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
             onclick='c_destroy($new_row[id],`city_admin.resident.destroy`,`.resident_dt`)'><i class='fas fa-trash'></i></a> 
             </div>"; // crud destroy param [row or model ID, route name, datatableID]

             return $btn;

            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        
        return view('admin.resident.index');
    }

    public function create()
    {
        // get all barangay which isn't attached to a specific user
        return $this->res(['results' => Barangay::all()]);
    }

   
    public function store(ResidentStoreRequest $request)
    {
         $check_existence = Resident::where('fname', $request->fname)
         ->where('mname', $request->mname)
         ->where('lname', $request->lname)
         ->first();

         if($check_existence) {
             return $this->error('Resident has already exist! Please check double check your entry', 422);
         }

         Resident::create($request->validated()); 

         return $this->res(['message' => 'Resident Added Successfully']);
    }
    
    public function update(ResidentUpdateRequest $request, Resident $resident)
    {
        // check if this resident is a brgy admin
        
        $resident->update($request->validated());
        
        $user = User::where('resident_id', $resident->id)->whereRelation('role', 'name', 'brgy_admin')->first();

        if($user) {

            $user->update(['name' => $resident->full_name, 'email' => $resident->email]);
        }

        return $this->res(['message' => 'Resident Updated Successfully']);
    }

    public function destroy(Resident $resident)
    {
	if ($resident->user()->count()){
		return $this->error('Cannot Delete, Resident still exist in other records', 422);	
	}
	else{
		$resident->delete();
        	return $this->res(['message' => 'Resident Deleted Successfully']);
	}
	
    }
}
