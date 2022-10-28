<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\All\TmpImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request , User $user, )
    {
        $data = $request->validate(['password' => 'nullable|min:6|max:15']);

        if($request->avatar)
        {
            $user->avatar ? $user->avatar->delete() : '';
            
            $user->addMedia(storage_path('app/public/tmp/'. request('avatar')))->toMediaCollection('avatar_image');

            TmpImage::where('filename', $request->avatar)->delete(); // get the tmp image from the db

            $this->log_activity($user, 'updated', 'Avatar', $user->name);

            return back()->with(['message' => 'Profile Updated Successfully']);
        }

        // update only the password if there is a request
        if($data['password']) 
        {
            $user->update(['password' => Hash::make($data['password'])]); // update password [hashed]

            $this->log_activity($user, 'updated', 'Password', 'some password');

            return back()->with(['message' => 'Password Updated Successfully']);
        }
        
        return back()->with(['error' => 'Image or Password field is required']);
    }
}
