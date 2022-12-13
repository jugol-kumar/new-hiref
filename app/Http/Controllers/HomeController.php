<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $jobs = Job::with(['companyDetails', 'user'])
            ->where('is_published', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('frontend.home', compact('jobs'));
    }

    public function singleJob($slug){
        $job = Job::with(['companyDetails', 'user'])
            ->where('slug', $slug)->first();
        return view('frontend.single_job', compact('job'));
    }


    public function about()
    {
        return view('frontend.about');
    }
    public function blog(){
        return view('frontend.blog');
    }

    public function faq()
    {
        return view('faq');
    }

    public function details($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('details', compact('course'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function checkout($slug)
    {
        $course = Course::where('slug', $slug)->first();
        return view('checkout', compact('course'));
    }



    // recruiter
    public function recruiter(){
        return view("recruiters.recuriator");
    }


    // seekers
    public function seekers(){
        return view('seekers.seekers');
    }

}
