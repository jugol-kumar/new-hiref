<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Education;
use App\Models\EducationLabel;
use App\Models\MessageDetail;
use App\Models\SeekerProfile;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SeekerController extends Controller
{
    public function dashboard(){
        $chatingJobs = MessageDetail::where('seeker_id', auth()->id())->count();
        $user        = User::where('id', Auth::id())->with('seeker')->first();

        return view('seekers.dashboard', compact('chatingJobs', 'user'));
    }
    public function firstStep(){
        $states =  Division::all();
        $categories = Category::all();
        $degrees = EducationLabel::all();

        $user = User::findOrFail(Auth::id())->load('seeker');

        return view('seekers.stapes.personal_details', compact('states', 'categories', 'degrees', 'user'));
    }
    public function subCatById($id){
        return SubCategory::where('category_id', $id)->with('child_categories')->get();
    }
    public function getCities($id){
        return Division::findOrFail($id)->load('districts');
    }
    public function getUpozelaByDid($id){
        return District::findOrFail($id)->load('upozilas');
    }
    public function getEducations($id){
        return Education::where('education_label_id', $id)->get();
    }

    public function firstStapeSave(Request $request): bool
    {

        $request->validate([
            'types' => 'required',
            'category_id' => 'required|integer',
            'subcategories' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upozillas' => 'required',
            'exp_min_sal' => 'required',
            'exp_max_sal' => 'required'
        ]);

        $user = SeekerProfile::where('user_id', Auth::id())->first();

        if ($user){
            $user->update([
                'user_id' => Auth::id(),
                'types' => $request->types,
                'category_id' => $request->category_id,
                'subcategories' => json_encode($request->subcategories),
                'division_id' => $request->division,
                'district_id' => $request->district,
                'upozillas' => json_encode($request->upozillas),
                'exp_min_sal' => $request->exp_min_sal,
                'exp_max_sal' => $request->exp_max_sal
            ]);
        } else{
            SeekerProfile::create([
                'user_id' => Auth::id(),
                'types' => $request->types,
                'category_id' => $request->category_id,
                'subcategories' => json_encode($request->subcategories),
                'division_id' => $request->division,
                'district_id' => $request->district,
                'upozillas' => json_encode($request->upozillas),
                'exp_min_sal' => $request->exp_min_sal,
                'exp_max_sal' => $request->exp_max_sal
            ]);
        }

        return true;
    }

    public function secondStapeSave(Request $request): bool
    {

        $user = Auth::user();
        $seeker = SeekerProfile::where('user_id', Auth::id())->first();

        if ($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic')->store('user', 'public');
            $user->photo = $file;
            $user->update();
        }

        $seeker->declined_date = $request->declined_date;
        $seeker->is_experienced = $request->is_experienced;
        $seeker->gender = $request->gender;
        $seeker->update();
        return true;
    }

    public function thirdStapeSave(Request $request): bool
    {
        $seeker = SeekerProfile::where('user_id', Auth::id())->first();
        $seeker->start_date = $request->start_date;
        $seeker->end_date = $request->end_date;
        $seeker->company_name = $request->company_name;
        $seeker->designation = $request->designation;
        $seeker->update();
        return true;
    }

    public function lastFormSave(Request $request){
        $seeker = SeekerProfile::where('user_id', Auth::id())->first();
        $seeker->education_id = $request->degree_label;
        $seeker->education_label_id = $request->degree_id;
        $seeker->uni_end_date = $request->uni_end_date;
        $seeker->uni_start_date = $request->uni_start_date;
        $seeker->university  = $request->university;
        $seeker->update();
        return response()->json([
            'status' => 200,
            'url' => URL::route('seeker.profileReview')
        ]);
    }

    public function profileReview(){
        $districts = District::all()->load('upozilas');
        $user        = User::findOrFail(Auth::id())->load(['seeker', 'seeker.division', 'seeker.district', 'seeker.educaiton', 'seeker.category', 'seeker.education_level', 'seeker.category']);

        return view('seekers.stapes.profile_bio', compact('districts', 'user'));
    }

    public function updateBio(Request $request){

        $request->validate([
           'first_name' => 'required',
           'last_name'  => 'required',
            'email'     => 'required',
            'full_address' => 'required',
            'about_bio' => 'required|max:1000',
            'resume' => 'required',
            'division' => 'required|integer',
        ]);

        $user = Auth::user();
        $seeker = SeekerProfile::where('user_id', Auth::id())->first();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name. " " . $request->last_name;
        $user->email = $request->email;
        $user->address = $request->full_address;
        $user->city_id = $request->division;
        $user->about = $request->about_bio;
        $user->update();

        if ($request->hasFile('resume')){
            $file = $request->file('resume')->store('user', 'public');
            $seeker->resume = $file;
            $seeker->update();
        }
        return response()->json([
            'status' => 200,
            'url' => URL::route('seeker.dashboard')
        ]);
    }

    public function profileInactiveShow(){
        return view('seekers.stapes.profile_inactive');
    }


}
