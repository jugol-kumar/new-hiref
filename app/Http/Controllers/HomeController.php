<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\District;
use App\Models\Division;
use App\Models\Job;
use App\Models\SubCategory;
use App\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $job->show_count += 1;
        $job->update();

        if (Auth::check() && Auth::user()->role == Properties::$seeker){
            Auth::user()->seeker->view_jobs += 1;
            Auth::user()->seeker->update();
        }

        return view('frontend.single_job', compact('job'));
    }

    public function allDistrict(Request $request){
        $query = $request->get('data');
        $data = District::where('name','LIKE','%'.$query.'%')->get();
        $output = '<ul class="list-unstyled">';
        foreach($data as $row){
            $output .= '<li>'.$row->name.'</li>';
        }
        $output .= '</ul>';
        echo $output;
    }

    public function getSubCategories($id){
        $categories = SubCategory::where('category_id', $id)->withCount('jobs')->get();
        return $categories;
    }

    public function searchJob(){
        $type = \request()->input('job_type');
        $loc  = \request()->input('loacation');
        $cat  = \request()->input('cat_id');
        $div  = \request()->input('div_id');

        $categories    = Category::withCount('jobs')->get();
        $divisions     = Division::withCount('jobs')->get();
        if ($cat != null){
            $subCategories = SubCategory::where('category_id', $cat)->withCount('jobs')->get();
        }else{
            $subCategories = [];
        }
        $jobs = Job::query()->with('district');
        if ($type != null){
            $jobs = $jobs->Where('title', 'LIKE', "%{$type}%");
        }
        if ($loc != null){
            $jobs = $jobs->WhereHas('district', function ($client) use($loc) {
                $client->where('name' , 'LIKE', "%${loc}%");
            });
        }
        if ($div != null){
            $jobs->where('division_id', $div);
        }
        if ($cat != null){
            $jobs->where('category_id', $cat);
        }

        $jobs = $jobs->paginate(12)->withQueryString();
        return view('frontend.filter_jobs', compact('jobs', 'categories', 'divisions', 'subCategories'));
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
