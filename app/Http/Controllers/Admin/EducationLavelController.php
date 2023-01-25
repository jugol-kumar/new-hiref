<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationLabel;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class EducationLavelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Backend/Education/EducationLevel', [
            'edu_lavels' => EducationLabel::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('label', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($edu) => [
                    'id'    => $edu->id,
                    'name'  => $edu->label,
                    'created_at' => $edu->created_at->format('Y-m')
                ]),
            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('education-level.index')
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
        EducationLabel::create([
            'label' => Request::input('name')
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
        EducationLabel::findOrFail($id)->delete();
        return back();
    }
}
