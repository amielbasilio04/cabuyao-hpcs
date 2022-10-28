<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Patient;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\User\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(User::whereRelation('role', fn($q) => $q->where('name', 'patient'))->get())
            ->addIndexColumn()
            ->addColumn('actions', function($row)
            {
                
                $btn = "<div class='btn-group'>
                <a href='javascript:void(0)' class='btn btn-outline-default btn-sm' onclick='showDateTime($row->id)'><i class='fas fa-eye'></i></a>";

                $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-default' 
                onclick='c_destroy($row->id,`admin.user.destroy`,`.patient_registration_dt`)'><i class='fas fa-trash'></i></a>
                </div>"; // crud destroy param [row or model ID, route name, datatableID]

             
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.patient_registration.index');
    }

    public function create()
    {
        return $this->res(['results' => Patient::whereDoesntHave('user')->get()]);
    }

    public function store(UserRequest $request)
    {
        $patient_registration_data = $request->validated();

        $patient = Patient::findOrFail($patient_registration_data['patient_id']);

     $user =   User::create([
                    'patient_id' => $patient_registration_data['patient_id'],
                    'name' => $patient->full_name, 
                    'email' => $patient->email, 
                    'password' => '$2y$10$UPNEWO.3925PqB8KN1tl..IFHJSKBINMWxKZNBWB9hBMfNlayuue6',
                    'role_id' => 2
                ]);

        $this->log_activity($user, 'added', 'User', $user->name);


        return $this->res(['message' => 'Patient Account Registered Successfully']);
    }

    public function destroy(User $user)
    {
        $this->log_activity($user, 'deleted', 'User', $user->name);

        $user->delete();

        return $this->res(['message' => 'Patient Account Deleted Successfully']);

    }
}
