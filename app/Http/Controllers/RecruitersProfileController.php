<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RecruitersProfileController extends Controller
{




    public function editProfile()
    {
        return view('recruiters.profile.edit_profile');
    }

    public function changeProfilePicture(Request $request){
        $user = Auth::user();

        if ($request->hasFile('profile_pic')){
            $exists = Storage::disk('public')->exists("storage/user/aNbgYc8ISJbs0uWPeEQSAhuAmogKtRhrwchUFnBi.png");
            if ($exists){
                Storage::disk('public')->delete($this->user->photo);
            }
            $file = $request->file('profile_pic')->store('user', 'public');
            $user->photo = $file;
            $user->update();
            toast('Profile Picture Updated Successfully Done.....', 'success');
            return back();
        }

        toast('Select Your Profile Picture', 'warning');
        return back();

    }

    public function editPersonalInfo(Request $request){
        $request->validate([
           'fname' => 'required|max:30',
           'dob'   => 'required',
           'address2' => 'required',
            'designation' => 'required',
            'gender' => 'required'
        ]);

        Auth::user()->update([
           'name' => $request->fname,
           'dob' => $request->dob,
           'address' => $request->address2,
           'gender' => $request->gender,
            'about' => $request->about_me,
        ]);
        Auth::user()->recruiter->update([
           'designation' => $request->designation,
        ]);

        toast('Info Update Successfully Done......', 'success');
        return back();

    }

    public function security(){
        return view('recruiters.profile.security');
    }

    public function updateEmail(Request $request){
        $this->validate($request,[
            'email' => 'required|unique:users',
        ]);
        Auth::user()->update([
            'email' => $request->email
        ]);

        toast('Email Change Successfully Done....','success');
        return back();
    }



    public function changePassword(Request $request){
        $this->validate($request,[
            'currentpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        $hashedPassword = $user->password;



        if ( Hash::check($request->currentpassword , $hashedPassword)){
            if (!Hash::check($request->password, $hashedPassword)){
                $user->update([
                    'password' => $request->password
                ]);
                Auth::logout();
                toast('Password Change Successfully Done', 'error');
                return redirect()->route('recruiter.login');
            }else{
                toast('New Password Can Not Be Same As Same Password', 'warning');
            }
        }else{
            toast('Current Password Not Match', 'error');
        }

        return back();
    }

    public function updateSocialLinks(Request $request){

        $request->validate([
            'twitter' => 'url',
            'facebook' => 'url',
            'instagram' => 'url',
            'linkedin' => 'url',
            'youtube' => 'url',
        ]);

        Auth::user()->update([
           'twitter_url' => $request->twitter,
           'youtube_url' => $request->youtube,
            'linkedin_url' => $request->linkedin
        ]);

        toast('Social Media Link Set Successfully Done....', 'success');
        return back();

    }




}
