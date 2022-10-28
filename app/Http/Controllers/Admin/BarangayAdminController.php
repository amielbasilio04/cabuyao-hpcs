<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Barangay;
use App\Models\Admin\Resident;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Resources\Admin\Barangay\BarangayAdminResource;
use App\Http\Requests\Admin\Barangay\BarangayAdminStoreRequest;
use App\Http\Requests\Admin\Barangay\BarangayAdminUpdateRequest;



class BarangayAdminController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $barangay_admins = BarangayAdminResource::collection(User::with('resident','barangay')->where('role_id', 2)->get());

            return DataTables::of($barangay_admins)
            ->addIndexColumn()
            ->addColumn('actions', function($row)
            {
                $new_row = collect($row);

                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='editBarangayAdmin($new_row)'><i class='fas fa-edit'></i></a>";

                if(!$new_row['is_activated'] == 1)
                {
                    $btn .= "
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-navy-blue'
                    onclick='crud_activate_deactivate($new_row[id], `city_admin.barangay_admin.update` , `activate`, `.barangay_admin_dt`, `Activate this Barangay Admin`)'>Activate</a>"; // param [model ID, Route, DT, Confirmation Msg]
 
                }
                else
                {
  
                    $btn .= "<div class='btn-group'>
                    <a href='javascript:void(0)' class='text-decoration-none btn btn-sm btn-outline-navy-blue'
                    onclick='crud_activate_deactivate($new_row[id], `city_admin.barangay_admin.update` , `deactivate`, `.barangay_admin_dt`, `Deactivate this Barangay Admin`)'>Deactivate</a>"; // param [model ID, Route, DT, Confirmation Msg]"

                }
             
                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                onclick='c_destroy($new_row[id],`city_admin.barangay_admin.destroy`,`.barangay_admin_dt`)'><i class='fas fa-trash'></i></a>
                </div>"; // crud destroy param [row or model ID, route name, datatableID]

                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
       
        return view('admin.barangay_admin.index');
    }

    public function create()
    {
        $results = [
            'residents' => Resident::all(),
            'barangays' => Barangay::all()
        ];

        return $this->res(compact('results'));
    }

   

    public function store(BarangayAdminStoreRequest $request)
    {
       // get the barangay admin by requested resident id or barangay_id
        $selected_brgy_admin = User::where('resident_id', $request->resident_id)
        ->orWhere('barangay_id', $request->barangay_id)
        ->where('role_id', 2)
        ->where('is_activated',1)
        ->first();

        // check if this barangay admin already exist
        if($selected_brgy_admin)
        {
            return $this->error('Only one Barangay Admin per barangay is allowed. Please select another one', 422);
        }

        // register one 
        $resident = Resident::find($request->resident_id);

        // create brgy admin + authentication account ; with default password
        User::create(['resident_id' => $resident->id,
            'barangay_id' => $request->barangay_id,
            'name' => $resident->fullname,
            'email' =>  $resident->email,
            'password' => '$2y$10$UPNEWO.3925PqB8KN1tl..IFHJSKBINMWxKZNBWB9hBMfNlayuue6',
            'role_id' => 2
        ]); 

        return $this->res(['message' => 'Barangay Admin Added Successfully']);

    }

    public function edit($id)
    {
        return $this->res(['results' => Barangay::all()]);
    }
    
    public function update(BarangayAdminUpdateRequest $request, User $user)
    {
        if($request->option)
        {
            // Activate || Deactivate Brgy. Admin
            return $request->option == 'activate' ? $user->update(['is_activated' => 1]) 
            : $user->update(['is_activated' => 0]);
        }
        else
        { 
            // check if the selected barangay is already occupied
            if(User::where('barangay_id', $request->barangay_id)->first()) {
                return $this->error('Only one Barangay Admin per barangay is allowed. Please select another barangay', 422);
            }

            // Update Brgy Admin's designated brgy
            $user->update($request->validated());

            return $this->res(['message' => 'Barangay Admin Transfered Successfully']);

        }


    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->res(['message' => 'Barangay Admin Deleted Successfully']);
    }
}
