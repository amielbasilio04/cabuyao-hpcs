<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Admin\HealthIssue;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class HealthIssueController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(HealthIssue::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "<a href='javascript:void(0)' class='btn btn-outline-navy-blue btn-sm' onclick='c_edit(`#m_health_issue`, `.health_issue_form :input`, [`#m_health_issue_title`, `Edit Health Issue`], [`.btn_add_health_issue`, `.btn_update_health_issue`], $row)'><i class='fas fa-edit'></i></a>";

                    $btn .= " <a href='javascript:void(0)' class='text-decoration-none btn  btn-sm btn-outline-navy-blue' 
                    onclick='c_destroy($row->id,`city_admin.health_issue.destroy`,`.health_issue_dt`)'><i class='fas fa-trash'></i></a> </div>"; // crud destroy param [row or model ID, route name, datatableID]
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }
        
        return view('admin.health_issue.index');
    }

    public function store(Request $request)
    {
        HealthIssue::create($request->validate(['type' => 'required|unique:health_issues']));

        return $this->res(['message' => 'Health Issue Added Successfully']);
    }

    public function update(Request $request, HealthIssue $health_issue)
    {
        $health_issue->update($request->validate(['type' => ['required', Rule::unique('health_issues')->ignore($health_issue)]]));

        return $this->res(['message' => 'Health Issue Updated Successfully']);
    }

    public function destroy(Healthissue $health_issue)
    {
        $health_issue->delete();

        return $this->res(['message' => 'Health Issue Deleted Successfully']);
    }
}
