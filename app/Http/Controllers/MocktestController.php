<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Mocktest;
use App\Models\SubCategory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class MocktestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Mocktest/List', [
            'mocktests' => Mocktest::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($mocktest) => [
                    'id' => $mocktest->id,
                    'name' => $mocktest->name,
                    'total_q' => $mocktest->total_q,
                    'duration' => $mocktest->duration,
                    'status' => $mocktest->status,
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('mocktests.index')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Mocktest/Create', [

            'categories' => Category::select('id', 'name')->get(),
            'url' => URL::route('mocktests.index'),
            'subqbycat_url' => URL::route('subqbycat'),
            // 'can' => [
            //     'createUser' => Auth::user()->can('create', User::class)
            // ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = Request::validate([
            'name' => 'required|max:150',
            'total_q' => 'required',
            'duration' => 'required',
            'category_id' => 'required',
            'status' => 'boolean',
        ]);

        $data['user_id'] = Auth::user()->id;

        $mocktest = Mocktest::create($data);

        $categoriesCount = Request::input('categories');

        if (count($categoriesCount)) {
            $mocktest->sub_categories()->sync($this->createArrayGroups($categoriesCount));
        }

        return Redirect::route('mocktests.index');

    }

    public function createArrayGroups($items)
    {
        $added = array();
        foreach($items as $item){
            $id = $item['id'];
            $added[$id] = ['question' => $item['take']];
        }

        return $added;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mocktest  $mocktest
     * @return Mocktest
     */
    public function show(Mocktest $mocktest)
    {
        return $mocktest->load(['sub_categories', 'sub_categories.questions' => function($question) {
            $question->limit('sub_categories.pivot.question');
        }]);

//        foreach ($mocktest->sub_categories() as $sub_category){
//            return $sub_category;
////            foreach ($sub_category->questions() as $question){
////                return $question;
////            }
//        }

//        return $mocktest->load(['sub_categories', 'sub_categories.']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mocktest  $mocktest
     * @return \Illuminate\Http\Response
     */
    public function edit(Mocktest $mocktest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mocktest  $mocktest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mocktest $mocktest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mocktest  $mocktest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mocktest $mocktest)
    {
        $mocktest->delete();
        return back();
    }
}
