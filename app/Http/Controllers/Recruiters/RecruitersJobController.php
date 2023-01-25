<?php

namespace App\Http\Controllers\Recruiters;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Company;
use App\Models\Country;
use App\Models\Division;
use App\Models\Job;
use App\Models\Skill;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitersJobController extends Controller
{


    public function allJobs()
    {
        $jobs = Job::where('creator', Auth::id())
            ->latest()
//            ->withCount('messageDetails')
            ->withCount('appliedUsers')
            ->with(['category', 'companyDetails.photos'])
            ->paginate(10);


        return view('recruiters.jobs.index', compact('jobs'));
    }

    public function createJob()
    {
        return view('recruiters.jobs.create', with(
            [
                'states' => Division::all(),
                'categories' => Category::select('id', 'name')->get(),
                'countries' => Country::select('currency', 'currency_name', 'currency_symbol', 'name', 'id')->get(),
                'companies' => Company::where('user_id', Auth::id())->with('photos')->get(),

            ]));
    }

    public function storeJob(Request $request)
    {

        $data = \Illuminate\Support\Facades\Request::validate([
            "title" => 'required',
            "types" => 'required',
            "label" => 'required',
            "category_id" => 'nullable|integer',
            "sub_category_id" => 'nullable|integer',
            "child_category_id" => 'nullable|integer',
            "currency" => 'required|integer',
            "min_salary" => 'required|integer',
            "max_salary" => 'required|integer',
            "min_experience" => 'required|integer',
            'max_experience' => 'required|integer',
            'experience_type' => 'required',
            "company" => 'required|integer',
            "creator" => 'nullable|integer',
            "declined_date" => 'required',
            "web_address" => 'required|url',
            "location" => 'nullable|string',
            "job_details" => 'required|min:200',
            "job_disc" => 'required|max:600',
//            "is_remote" => 'boolean',
//            "fultime_remote" => 'boolean',
//            "is_published" => 'boolean',
//            "is_featured" => 'boolean',
//            "tags" => 'nullable|array',
//            "skills" => 'nullable|array',
        ]);


        $skills = array_map(function ($item) {
            return $item->value;
        }, json_decode($request->skills));

        $tags = array_map(function ($item) {
            return $item->value;
        }, json_decode($request->tags));


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
        foreach ($tags as $value) {
            Tag::updateOrCreate([
                'name' => $value
            ]);
        }
        foreach ($skills as $value) {
            Skill::updateOrCreate([
                'name' => $value
            ]);
        }

        Job::create($data);

        toast('Successfully created Job', 'success');
        return redirect()->route('recruiter.allJobs');


    }

    public function editJob($slug)
    {
        $job = Job::where('slug', $slug)->with(['company', 'category'])->first();
        $categories = Category::select('id', 'name')->get();
        $subCategories = SubCategory::select('id', 'name')->get();
        $cCategories = ChildCategory::select('id', 'name')->get();

        $countries = Country::select('currency', 'currency_name', 'currency_symbol', 'name', 'id')->get();
        $companies = Company::with('photos')->get();

        return view('recruiters.jobs.edit', compact('job', 'categories', 'countries', 'companies', 'subCategories', 'cCategories'));
    }

    public function updateJobStatus(Request $request)
    {
        $job = Job::findOrFail($request->job_id);
        $job->lived = $request->job_status;
        $job->save();
        toast('Successfully status changed...', 'success');
        return back();
    }

    public function updateJob(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $data = \Illuminate\Support\Facades\Request::validate([
            "title" => 'required',
            "types" => 'required',
            "label" => 'required',
            "category_id" => 'nullable|integer',
            "sub_category_id" => 'nullable|integer',
            "child_category_id" => 'nullable|integer',
            "currency" => 'required|integer',
            "min_salary" => 'required|integer',
            "max_salary" => 'required|integer',
            "min_experience" => 'required|integer',
            'max_experience' => 'required|integer',
            'experience_type' => 'required',
            "company" => 'required|integer',
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


        $skills = array_map(function ($item) {
            return $item->value;
        }, json_decode($request->skills));

        $tags = array_map(function ($item) {
            return $item->value;
        }, json_decode($request->tags));


        $data["tags"] = json_encode($tags);
        $data["skills"] = json_encode($skills);
        $data['creator'] = Auth::id();
        $data['is_remote'] = filled($request->is_remote);
        $data['fultime_remote'] = filled($request->fultime_remote);
        $data['is_published'] = filled($request->is_published);
        $data['is_featured'] = filled($request->is_featured);
        $data['lived'] = $request->job_status;


        $data['user_id'] = Auth::id();
        foreach ($tags as $value) {
            Tag::updateOrCreate([
                'name' => $value
            ]);
        }
        foreach ($skills as $value) {
            Skill::updateOrCreate([
                'name' => $value
            ]);
        }

        $job->update($data);

        toast('Successfully update job', 'success');
        return redirect()->route('recruiter.allJobs');
    }

    public function deleteJob($id)
    {
        Job::findOrFail($id)->update(['lived' => 'deleted']);
        toast('Successfully delete job', 'success');
        return redirect()->route('recruiter.allJobs');
    }
}
