<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\FamilyHistory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class FamilyHistoryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(FamilyHistory::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "<a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='c_edit(`#m_family_history`, `.family_history_form :input`, [`#m_family_history_title`, `Edit Health Issue`], [`.btn_add_family_history`, `.btn_update_family_history`], $row)'><i class='fas fa-edit'></i></a>";

                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                    onclick='c_destroy($row->id,`city_admin.family_history.destroy`,`.family_history_dt`)'><i class='fas fa-trash'></i></a> </div>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        return view('admin.family_history.index');
    }

    public function store(Request $request)
    {
        FamilyHistory::create($request->validate(['type' => 'required|unique:family_histories']));

        return $this->res(['message' => 'Family History Added Successfully']);
    }

    public function update(Request $request, FamilyHistory $family_history)
    {
        $family_history->update($request->validate(['type' => ['required',Rule::unique('family_histories')->ignore($family_history)]]));

        return $this->res(['message' => 'Family History Updated Successfully']);
    }

    public function destroy(FamilyHistory $family_history)
    {
        $family_history->delete();

        return $this->res(['message' => 'Family History Deleted Successfully']);
    }
}
