<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile(){
        $user = User::find(session('user')->id);
        return view('profile', compact('user'));
    }

    public function updatePicture(Request $request){
        $user = User::find(session('user')->id);

        if($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic');
            $filename = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$filename);

            $user->update([
                'profile_picture'=>$filename
            ]);
        }
        return back()->with('success', 'Profile updated');
    }

    public function updateProfile(Request $request){
        $user = User::find(session('user')->id);

        $user->update([
            'fullname' => $request->fullname,
            'phone_number' => $request->phoneNumber,
            'address' => $request->address,
            'short_bio' => $request->bio
        ]);
    
        if ($request->filled('currentPassword')) {
            // Verify current password is correct
            if (!Hash::check($request->currentPassword, $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            
            }
            if (!$request->confirmPassword == $request->newPassword) {
                return back()->with('error', 'Confirm password does not match the new password.');
            }

            $user->update([
                'password' => Hash::make($request->newPassword),
            ]);
        }
        
        return back()->with('success', 'Profile updated successfully.');
    }
}
