<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendJobController extends Controller
{


    public function singleJob($slug){
        $job = Job::with(['companyDetails', 'user'])->withCount('messageDetails')
            ->where('slug', $slug)->first();
        $job->show_count += 1;
        $job->update();
        if (Auth::check() && Auth::user()->role == Properties::$seeker){
            Auth::user()->seeker->view_jobs += 1;
            Auth::user()->seeker->update();
        }

        $applyStatus = auth()->user()?->whereHas('appliedJobs', function ($query) use($job) {
            $query->where('job_id', $job->id);
        })->count() ;

        return view('frontend.single_job', compact('job', 'applyStatus'));
    }


    public function applyJob(Request $request){

        $user = User::findOrFail($request->input('user_id'));

        $user->appliedJobs()->attach([
            'job_id' => $request->input('job_id')
        ]);

        toast('Successfully Applied....', 'success');
        return back();
    }
}
