<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  
    public function all()
    {
        return $this->res(request()->all());
    }

    public function res($data)
    {
        return response()->json($data,201);
    }

    public function error($message, $code = 401)
    {
        abort($code, $message);
    }

    //spatie
    public function log_activity($model, $event, $model_name, $model_property_name = '', $opt = 'a')
    {
    
        $user = auth()->user();

        $name = $user->name ?? 'New User' ;
        activity()
        ->causedBy($user)
        ->performedOn($model)
        ->withProperties(['name', 'description'])
        ->log("$name has $event $opt $model_name - $model_property_name");
        
        
    }
}
