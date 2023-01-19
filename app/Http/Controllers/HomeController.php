<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Company;
use App\Models\Course;
use App\Models\District;
use App\Models\Division;
use App\Models\Job;
use App\Models\SaveJob;
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
        $categories = Category::latest()->get();
        $companies = Company::withCount("jobs")->with("photos")->get();
        return view('frontend.home', compact('jobs', 'categories', 'companies'));
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
        $sCat = \request()->input('s_cat_id');

        $categories    = Category::withCount('jobs')->get();
        $divisions     = Division::withCount('jobs')->get();
        if ($cat != null){
            $subCategories = SubCategory::where('category_id', $cat)->withCount('jobs')->get();
        }else{
            $subCategories = [];
        }

        $jobs = Job::query()
//            ->where('is_published', Properties::$true)
//            ->where('lived', Properties::$lived)
            ->orderBy('is_featured', Properties::$desc)
            ->with('district')
            ->withCount('messageDetails');

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
        if ($sCat != null){
            $jobs->where('sub_category_id', $sCat);
        }

        $jobs = $jobs->paginate(12)->withQueryString();

        return view('frontend.filter_jobs', compact('jobs', 'categories', 'divisions', 'subCategories'));
    }

    public function saveJob($slug, $id){
        if ($id){
            SaveJob::create([
                'job_id' => $id,
                'user_id' => Auth::id()
            ]);
            toast('Job Saved Your Profile', 'success');
            return back();
        }
        toast('Something Want Wrong. Try Again', 'error');
        return back();
    }

    public function singleBlog($slug){
        $blog = Blog::where('slug', $slug)
            ->with(['user', 'category', 'category.blogs','comments.user','comments.replayComments', 'comments' => function($comment){
                return $comment->where('comment_id', null);
            }])->first();

        if (Auth::check() && Auth::user()->role != 'admin'){
            $blog->view_count = $blog->view_count++;
            $blog->save();
        }else if (!Auth::check()){
            $blog->view_count = $blog->view_count + 1;
            $blog->save();
        }

        return view('frontend.single_blog', compact('blog'));
    }

    public function allCategories(){
        $categories = Category::with('sub_categories')->get();
//        return $categories;
        return view('frontend.categories', compact('categories'));
    }


    public function about()
    {
        return view('frontend.about');
    }
    public function blog(){
        $request = \request();
        if ($request->searchText != null){
            $blogs = Blog::where('publication_status', 1)
                ->where('title', 'like', "%{$request->searchText}%")
                ->orWhere('description', 'like', "%{$request->searchText}%")
                ->orWhere('content', 'like', "%{$request->searchText}%")
                ->with(['user', 'category'])->get();
        }else{
            $blogs = Blog::where('publication_status', 1)->with(['user', 'category'])->get();
        }
        $text = $request->searchText;
        return view('frontend.blogs', compact('blogs', 'text'));
    }
    public function allApproveBlogs(){
        $request = \request();
        if ($request->searchText != null){
            $blogs = Blog::where('publication_status', 1)
                ->where('title', 'like', "%{$request->searchText}%")
                ->orWhere('description', 'like', "%{$request->searchText}%")
                ->orWhere('content', 'like', "%{$request->searchText}%")
                ->with(['user', 'category'])->get();
        }else{
            $blogs = Blog::where('publication_status', 1)->with(['user', 'category'])->get();
        }
        $text = $request->searchText;
        return view('frontend.blogs', compact('blogs', 'text'));
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

    public function jobList(){
        return $this->searchJob();
    }



}
