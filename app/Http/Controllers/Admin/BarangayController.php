<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Barangay;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\Barangay\BarangayRequest;
use Yajra\DataTables\Facades\DataTables;

class BarangayController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Barangay::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "<a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='c_edit(`#m_barangay`, `.barangay_form :input`, [`#m_barangay_title`, `Edit barangay`], [`.btn_add_barangay`, `.btn_update_barangay`], $row)'><i class='fas fa-edit'></i></a>";

                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                    onclick='c_destroy($row->id,`city_admin.barangay.destroy`,`.barangay_dt`)'><i class='fas fa-trash'></i></a> </div>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        return view('admin.barangay.index');
    }

    public function store(BarangayRequest $request)
    {
        Barangay::create($request->validate(['name' => 'required|unique:barangays', 'lat' => 'required', 'long' => 'required']));

        return $this->res(['message' => 'Barangay Added Successfully']);
    }

    public function update(Request $request, Barangay $barangay)
    {
        $barangay->update($request->validate(['name' => 'required', 'lat' => 'required', 'long' => 'required']));

        return $this->res(['message' => 'Barangay Updated Successfully']);

    }

    public function destroy(Barangay $barangay)
    {	
        if ($barangay->resident()->count()){
		return $this->error('Cannot Delete, Barangay Data is used in records', 422);	
	}
	else{
		$barangay->delete();
        	return $this->res(['message' => 'Barangay Deleted Successfully']);
	}
	
    }
}
