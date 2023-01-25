<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationLabel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Backend/Education/Educations', [
            'educations' => Education::query()
                ->with('eduLabel')
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('education_name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($edu) => [
                    'id'         => $edu->id,
                    'name'       => $edu->education_name,
                    'elabel'     => $edu->eduLabel,
                    'created_at' => $edu->created_at->format('Y-m')
                ]),
            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('education.index'),
            'eduLabels' => EducationLabel::all()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        Education::create([
            'education_label_id' => Request::input('label_id'),
            'education_name' => Request::input('name')
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Education::findOrFail($id)->delete();
        return back();
    }
}
