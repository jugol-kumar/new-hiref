<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Division;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Request;

class FrontendCompanyController extends Controller
{

    public function getAllCompanies(){
        $companies = Company::paginate(12)->withQueryString();
        $categories    = Category::withCount('jobs')->get();
        $divisions     = Division::withCount('jobs')->get();
        $cat = null;
        if ($cat != null){
            $subCategories = SubCategory::where('category_id', $cat)->withCount('jobs')->get();
        }else{
            $subCategories = [];
        }
        return view('frontend.comapny.filter_companies', compact('companies', 'categories', 'divisions', 'subCategories'));
    }

    public function singleCompany(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('id',Request::input('id'))->withCount('jobs')->with('photos')->first();
        return view('frontend.comapny.about_company', compact('company'));
    }

    public function singleCompanyJobs(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $company = Company::where('id',Request::input('id'))->withCount('jobs')->with('photos')->first();
        $company->setRelation('jobs', $company->jobs()->paginate(10)->withQueryString());
        return view('frontend.comapny.company_jobs', compact('company'));
    }





}
