<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Question/List', [
            'questions' => Question::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('title', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn ($question) => [
                    'id' => $question->id,
                    'title' => $question->title,
                    'answer' => $question->answer,
                    'category' => $question->category->name,
                ]),

            'categories' => Category::all(),

            'filters' => Request::only(['search', 'perPage']),
            'url' => URL::route('questions.index'),
            // 'can' => [
            //     'createUser' => Auth::user()->can('create', User::class)
            // ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Question/Create', [

            'categories' => Category::select('id', 'name')->get(),
            'sub_categories' => SubCategory::query()
                ->when(Request::input('category_id'), function ($query, $category_id) {
                    $query->where('category_id', $category_id);
                })
                ->select('id', 'name', 'category_id')->get(),
            'child_categories' => ChildCategory::query()
                ->when(Request::input('sub_category_id'), function ($query, $sub_category_id) {
                    $query->where('sub_category_id', $sub_category_id);
                })
                ->select('id', 'name', 'sub_category_id')->get(),
                'url' => URL::route('questions.index'),
                'subbycat_url' => URL::route('subbycat'),
                'childbysubcat_url' => URL::route('childbysubcat'),
            // 'can' => [
            //     'createUser' => Auth::user()->can('create', User::class)
            // ]
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
        Question::create(
            Request::only(
                'title',
                'category_id',
                'sub_category_id',
                'child_category_id',
                'a',
                'b',
                'c',
                'd',
                'e',
                'answer',
                'feedback'
            )
        );

        return Redirect::route('questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return Question
     */
    public function show(Question $question)
    {
        return $question->load(['category', 'sub_category', 'child_category']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
