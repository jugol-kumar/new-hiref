<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Backend/Company', [
            'companies' => Company::query()->with(["photos", "companyCity"])
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($company) => [
                    'id'            => $company->id,
                    'name'          => $company->name,
                    'email'         => $company->email,
                    'phone'         => $company->phone,
                    'type'          => $company->type,
                    'logo'          => global_asset($company->photos->count() > 0 ? $company->photos[0]->filename : null),
                    'starting_date' => $company->starting_date,
                    'employee_size' => $company->employee_size,
                    'city'          => $company->companyCity,
                    'website'       => $company->website,
                    'address'       => $company->address,
                    'details'       => $company->details,
                ]),
            'cities' => City::where('country_id', 19)->select('id','name')->get(),
            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('companies.index')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = Request::validate([
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
        $data['creator'] = Auth::id();

        $company = Company::create($data);

        if (Request::hasFile('cover')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[0]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[0]->filename);
            }

            $file = Request::file('cover')->store('companies/cover', 'public');
            Gallery::updateOrCreate([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }

        if (Request::hasFile('logo')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[1]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[1]->filename);
            }
            $file = Request::file('logo')->store('companies/logo', 'public');
            Gallery::updateOrCreate([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }


        return redirect()->route('companies.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return array
     */
    public function show(Company $company)
    {
        return $data =  [
            "data" => $company->load('photos'),
            "cover" => global_asset($company->photos->count() > 0 ? $company->photos[0]->filename : null),
            "logo" => global_asset($company->photos->count() > 0 ? $company->photos[1]->filename : null),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return array
     */
    public function update(Request $request, Company $company)
    {
    }

    public function updateCompany($id){

        $company = Company::findOrfail($id);

        $data = Request::validate([
            'name'          => 'required|max:50',
            'email'         => 'required|max:30',
            'phone'         => 'required|max:15',
            'type'          => 'required',
            'cover'         => 'nullable',
            'logo'          => 'nullable',
            'starting_date' => 'required',
            'employee_size' => 'required',
            'city'          => 'required|integer',
            'website'       => 'required|url',
            'address'       => 'required',
            'details'       => 'nullable|max:400',
        ]);
        $data['creator'] = Auth::id();

        $company->update($data);

        if (Request::hasFile('cover')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[0]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[0]->filename);
            }

            $file = Request::file('cover')->store('companies/cover', 'public');
            $company->photos[0]->update([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }
        if (Request::hasFile('logo')){
            $exists = Storage::disk('public')->has($company->photos->count() > 0 ? $company->photos[1]->filename : "null");
            if ($exists){
                Storage::disk('public')->delete($company->photos[1]->filename);
            }

            $file = Request::file('logo')->store('companies/logo', 'public');
            $company->photos[1]->update([
                'imageable_id' => $company->id,
                'imageable_type' => 'App\\Models\\Company',
                'filename' => $file
            ]);
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
