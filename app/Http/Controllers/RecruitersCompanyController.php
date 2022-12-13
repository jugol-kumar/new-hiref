<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Gallery;
use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecruitersCompanyController extends Controller
{
    public function allCompanies()
    {
        $companies = Company::where('user_id', Auth::id())->with('photos')->withCount("jobs")->paginate(10);

        return view('recruiters.company.index', compact('companies'));
    }

    public function saveCompany(Request $request){
       $data = $request->validate([
            'name'          => 'required|max:50',
            'email'         => 'required|max:30',
            'phone'         => 'required|max:15',
            'type'          => 'required',
            'cover'         => 'required',
            'logo'          => 'required',
            'starting_date' => 'required',
            'employee_size' => 'required',
            'city'          => 'required|integer',
            'website'       => 'required|url',
            'address'       => 'required',
            'details'       => 'nullable|max:400',
       ]);


        $data['user_id'] = Auth::id();
        $data['creator'] = Auth::id();

        $company = Company::create($data);

        $company->users()->attach(Auth::id());


        if ($request->hasFile('cover')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[0]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[0]->filename);
            }

            $file = $request->file('cover')->store('companies/cover', 'public');
            Gallery::updateOrCreate([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }

        if ($request->hasFile('logo')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[1]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[1]->filename);
            }
            $file = $request->file('logo')->store('companies/logo', 'public');
            Gallery::updateOrCreate([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }

        toast('Company Create Successfully Done...', 'success');
        return redirect()->route('recruiter.allCompanies');
    }

    public function deleteCompany($id)
    {
        Company::findOrfail($id)->delete();
        toast('Company Delete Successfully Done...', 'success');
        return back();
    }


}
