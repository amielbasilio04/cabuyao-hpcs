<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Admin\Resident;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\Resident\ResidentStoreRequest;
use App\Http\Requests\Shared\Resident\ResidentUpdateRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Resources\User\ResidentResource;

class ResidentController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(ResidentResource::collection(Resident::with('barangay')->where('barangay_id', auth()->user()->barangay_id)->get()))
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
             $new_row = collect($row);

             $btn = "<div class='btn-group'>
                        <a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='c_edit(`#m_resident`, `.resident_form :input`, [`#m_resident_title`, `Edit Resident`], [`.btn_add_resident`, `.btn_update_resident`], $new_row)'><i class='fas fa-edit'></i></a>";
                        
             $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
             onclick='c_destroy($new_row[id],`brgy_admin.resident.destroy`,`.resident_dt`)'><i class='fas fa-trash'></i></a> 
             </div>"; // crud destroy param [row or model ID, route name, datatableID]

             return $btn;

            })
            ->rawColumns(['actions'])
            ->make(true);
        }
        
        return view('user.resident.index');   
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

        $resident = Resident::create($request->validated() + ['barangay_id' => auth()->user()->barangay_id]);

        $this->log_activity($resident, 'added', 'Resident', $resident->full_name );

        return $this->res(['message' => 'Resident Added Successfully']);

    }

    public function update(ResidentUpdateRequest $request, Resident $resident)
    {
        $resident->update($request->validated());

        $this->log_activity($resident, 'updated', 'Resident', $resident->full_name );

        return $this->res(['message' => 'Resident Updated Successfully']);
    }

    public function destroy(Resident $resident)
    {

	if ($resident->user()->count()){
		return $this->error('Cannot Delete, Resident still exist in other records', 422);	
	}
        
	else{
		$this->log_activity($resident, 'deleted', 'Resident', $resident->full_name );
        
        	$resident->delete();

        	return $this->res(['message' => 'Resident Deleted Successfully']);
	}

    }
}
