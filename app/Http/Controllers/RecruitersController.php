<?php

namespace App\Http\Controllers;

use App\Mail\VerificationWorkMail;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Company;
use App\Models\Country;
use App\Models\Division;
use App\Models\EducationLabel;
use App\Models\Job;
use App\Models\Recruiter;
use App\Models\SaveJob;
use App\Models\Skill;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\VerifyWorkMailNotefication;
use App\Properties;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class RecruitersController extends Controller
{

    public function makeProfile(){
        return view('recruiters.profile.build_profile');
    }

    public function updateBio(Request $request){

        $user = Auth::user();

        if ($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic')->store('user', 'public');
            $user->photo = $file;
        }
        $user->name       = $request->first_name. " ". $request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->gender     = $request->gender;
        $user->email      = $request->email;
        $user->update();


        $user->recruiter->update([
           'company_name' => $request->c_full_name,
            'company_sname' => $request->c_short_name,
            'designation' => $request->designation,
            'company_address' => $request->full_address,
            'emp_size' => $request->employee_size,
            'hot_industry' => $request->hot_industry
        ]);

        return response()->json([
            'status' => 200,
            'url' => URL::route('recruiter.dashboard')
        ]);
    }

    public function uploadBusinessFile(){
        return view('recruiters.profile.upload_business_file');
    }

    public function verifyWorkEmail(Request $request){
        $request->validate([
           'work_mail' => 'required|email',
        ]);
        $user = User::findOrFail(Auth::id());
        $user->recruiter->work_mail = $request->work_mail;
        $user->recruiter->update();
        Mail::to($user->recruiter->work_mail)->send(new VerificationWorkMail($user));
        toast('Send verification email on your work mail. please verification your email...');
        return redirect()->route('recruiter.dashboard');
    }


    public function showBeforeVerify(){
        return view('recruiters.profile.wait_for_verify');
    }

    public function verificationWorkEmail(){
        $mail = base64_decode(\request()->input('_token'));
        $rec = Recruiter::where('work_mail', $mail)->first();
        if ($rec){
            $rec->work_mail_verified_at = Carbon::now();
            $rec->status = Properties::$waiting;
            $rec->update();
            toast('Now Your Work-Mail Is Verified', 'success');
            return redirect()->route('recruiter.dashboard');
        }else{
            toast('Verification token is wrong', 'error');
            return redirect()->route('recruiter.dashboard');
        }
    }

    public function verifyBusinessFile(Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('business_files')){
            $file = $request->file('business_files')->store('user', 'public');
            $user = User::findOrFail(Auth::id());
            $user->recruiter->business_file = $file;
            $user->recruiter->status = Properties::$waiting;
            $user->recruiter->update();
        }
        toast('Wait for verification your profile...');
        return redirect()->route('recruiter.dashboard');
    }


    public function waitForVerify(){
        return view('recruiters.profile.wait_for_verify');
    }

    public function cancelVerifyRequest(){
        return view('recruiters.profile.cancel_verify');
    }

    public function profileInactive(){
        return view('recruiters.profile.profile_inactive');
    }


    public function allJobs(){
        $jobs = Job::where('creator', Auth::id())
            ->latest()
            ->withCount('messageDetails')
            ->with(['category', 'companyDetails.photos'])
            ->paginate(10);

        return view('recruiters.jobs.index', compact('jobs'));
    }

    public function saveJobs(){
        $jobs = SaveJob::where('user_id', Auth::id())
            ->latest()
            ->with(['job','job.category', 'job.companyDetails.photos'])
            ->paginate(10);

        $save = true;
        return view('recruiters.jobs.save_jobs', compact('jobs' , 'save'));
    }
    public function removeSaveJOb($id){
        SaveJob::findOrFail($id)->delete();
        toast('Successfully remove save job', 'success');
        return back();
    }

    public function createJob(){

        return view( 'recruiters.jobs.create', with(
        [
            'states'     => Division::all(),
            'categories' => Category::select('id', 'name')->get(),
            'countries'  => Country::select('currency', 'currency_name', 'currency_symbol', 'name', 'id')->get(),
            'companies'  => Company::where('user_id', Auth::id())->with('photos')->get(),

        ]));
    }

    public function updateJobStatus(Request $request){
        $job = Job::findOrFail($request->job_id);
        $job->lived = $request->job_status;
        $job->save();
        toast('Successfully status changed...', 'success');
        return back();
    }


    public function getSubCat($id){
        $sub_categories = SubCategory::where('category_id', $id)->get();
        return response()->json(['data' => $sub_categories], 200);
    }

    public function getChildCat($id){
        $sub_categories = ChildCategory::where('sub_category_id', $id)->get();
        return response()->json(['data' => $sub_categories], 200);
    }



    public function storeJob(Request $request){

        $data = \Illuminate\Support\Facades\Request::validate([
            "title" => 'required',
            "types" => 'required',
            "label" =>  'required',
            "category_id" => 'nullable|integer',
            "sub_category_id" =>  'nullable|integer',
            "child_category_id" => 'nullable|integer',
            "currency" => 'required|integer',
            "min_salary" => 'required|integer',
            "max_salary" => 'required|integer',
            "min_experience" => 'required|integer',
            'max_experience' => 'required|integer',
            'experience_type'=> 'required',
            "company" =>'required|integer',
            "creator" => 'nullable|integer',
            "declined_date" => 'required',
            "web_address" => 'required|url',
            "location" => 'nullable|string',
            "job_details" => 'required|min:200'
//            "is_remote" => 'boolean',
//            "fultime_remote" => 'boolean',
//            "is_published" => 'boolean',
//            "is_featured" => 'boolean',
//            "tags" => 'nullable|array',
//            "skills" => 'nullable|array',
        ]);


        $skills =  array_map(function ($item){
            return $item->value;
        } ,json_decode($request->skills));

        $tags =  array_map(function ($item){
            return $item->value;
        } ,json_decode($request->tags));


        $data["tags"] = json_encode($tags);
        $data["skills"] = json_encode($skills);
        $data['creator'] = Auth::id();
        $data['is_remote'] = filled($request->is_remote);
        $data['fultime_remote'] = filled($request->fultime_remote);
        $data['is_published'] = filled($request->is_published);
        $data['is_featured'] = filled($request->is_featured);
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['lived'] = $request->job_status;


        $data['user_id'] = Auth::id();
        foreach ($tags as $value){
            Tag::updateOrCreate([
                'name' => $value
            ]);
        }
        foreach ($skills as $value){
            Skill::updateOrCreate([
                'name' => $value
            ]);
        }

        Job::create($data);

        toast('Successfully created Job', 'success');
        return redirect()->route('recruiter.allJobs');


    }

    public function editJob($slug){
        $job = Job::where('slug', $slug)->with(['company', 'category'])->first();
        $categories = Category::select('id', 'name')->get();
        $subCategories = SubCategory::select('id', 'name')->get();
        $cCategories = ChildCategory::select('id', 'name')->get();

        $countries = Country::select('currency', 'currency_name', 'currency_symbol', 'name', 'id')->get();
        $companies = Company::with('photos')->get();

        return view('recruiters.jobs.edit', compact('job', 'categories', 'countries', 'companies', 'subCategories', 'cCategories'));
    }

    public function updateJob(Request $request, $id){
        $job = Job::findOrFail($id);

        $data = \Illuminate\Support\Facades\Request::validate([
            "title" => 'required',
            "types" => 'required',
            "label" =>  'required',
            "category_id" => 'nullable|integer',
            "sub_category_id" =>  'nullable|integer',
            "child_category_id" => 'nullable|integer',
            "currency" => 'required|integer',
            "min_salary" => 'required|integer',
            "max_salary" => 'required|integer',
            "min_experience" => 'required|integer',
            'max_experience' => 'required|integer',
            'experience_type'=> 'required',
            "company" =>'required|integer',
            "creator" => 'nullable|integer',
            "declined_date" => 'required',
            "web_address" => 'required|url',
            "location" => 'nullable|string',
            "job_details" => 'required|min:200'
//            "is_remote" => 'boolean',
//            "fultime_remote" => 'boolean',
//            "is_published" => 'boolean',
//            "is_featured" => 'boolean',
//            "tags" => 'nullable|array',
//            "skills" => 'nullable|array',
        ]);


        $skills =  array_map(function ($item){
            return $item->value;
        } ,json_decode($request->skills));

        $tags =  array_map(function ($item){
            return $item->value;
        } ,json_decode($request->tags));



        $data["tags"] = json_encode($tags);
        $data["skills"] = json_encode($skills);
        $data['creator'] = Auth::id();
        $data['is_remote'] = filled($request->is_remote);
        $data['fultime_remote'] = filled($request->fultime_remote);
        $data['is_published'] = filled($request->is_published);
        $data['is_featured'] = filled($request->is_featured);
        $data['lived'] = $request->job_status;


        $data['user_id'] = Auth::id();
        foreach ($tags as $value){
            Tag::updateOrCreate([
                'name' => $value
            ]);
        }
        foreach ($skills as $value){
            Skill::updateOrCreate([
                'name' => $value
            ]);
        }

        $job->update($data);

        toast('Successfully update job', 'success');
        return redirect()->route('recruiter.allJobs');
    }



    public function deleteJob($id){

        Job::findOrFail($id)->update(['lived' => 'deleted']);
        toast('Successfully delete job', 'success');
        return redirect()->route('recruiter.allJobs');

    }

}
