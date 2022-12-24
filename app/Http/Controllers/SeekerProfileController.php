<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Division;
use App\Models\EducationLabel;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SeekerProfileController extends Controller
{



    public function showProfile(){
        $user = User::where('id', Auth::id())->with('seeker', 'seeker.category', 'seeker.division', 'seeker.district', 'seeker.education_level', 'seeker.educaiton')->first();
        return view('seekers.profile.show_profile', compact('user'));
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

    public function editProfile(){

        $states        =  Division::all();
        $categories    = Category::all();
        $subCategories = SubCategory::with('child_categories')->get();
        $degrees       = EducationLabel::all();
        $user          = User::findOrFail(Auth::id())->load('seeker');

        return view('seekers.profile.edit_profile',[
            'user'          => $user,
            'states'        => $states,
            'categories'    => $categories,
            'subCategories' => $subCategories,
            'degrees'       => $degrees
        ]);
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

        toast('Info Update Successfully Done......', 'success');
        return back();

    }

    public function security(){
        return view('seekers.profile.security');
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

    public function updateSkills(Request $request){

        Auth::user()->seeker->update([
            'skills' => json_encode($request->tags)
        ]);

        return response()->json(['success' => "Skills updated successful"],  200);
    }

    public function updateProtfolio(Request $request){

        Auth::user()->update([
            'portfolio_url' => $request->portfolio_url
        ]);

        return response()->json(['success' => "Portfolio updated successful"],  200);

    }

    public function uploadResume(){
        return view('seekers.profile.upload_resume');
    }

    public function greetingChat(){
        return view('seekers.profile.greeting_chat');
    }

    public function switchProfile(){
        return view('seekers.profile.switch_profile');
    }

}
