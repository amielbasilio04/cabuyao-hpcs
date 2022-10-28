@extends('layouts.admin.admindashboard')

@section('title', 'Admin | Health Issues')

@section('content')

{{-- CONTAINER --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg_navy_blue">
                    <a class=" float-end btn btn-sm btn_green rounded me-3" href="javascript:void(0)" onclick="toggle_modal('#m_health_issue', '.health_issue_form', ['#m_health_issue_title','Add Health Issue'], ['.btn_add_health_issue','.btn_update_health_issue'])">Add Health Issue +</a><br>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered health_issue_dt py-3">
                            <caption>List of Common Health Issue <i class="fas fa-head-side-mask ms-1"></i> </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--Display List of Health Issue --}}
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--End CONTAINER--}}

@endsection