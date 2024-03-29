<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin/settings');
    }
    public function updateprofile(Request $request)
    {
        $this->validate($request,[
            'name'  =>   'required',
            'email'  =>   'required|email',
            'image'  =>   'required|image',
        ]);
        $user = User::findOrFail(Auth::id());
        
        if($request->has('image')){
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time(). '.'.$ext;
            $image->storeAs('public/admin',$file);//above 4 line process the image code
            $user->image =  $file;//ai code ta image ke insert kore
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->save();
        
        Toastr::success('Amin Successfully Updated', 'success');
        return redirect()->back();
    }
 


    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->back();
            } 
            else 
            {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }




}
