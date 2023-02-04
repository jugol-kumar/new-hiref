<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Review;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {

        return inertia('Backend/Reviews/Review', [
            'reviews' => Review::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($review) => [
                    'id' => $review->id,
                    'name' => $review->name,
                    'photo' => $review->photo,
                    'designations'  => $review->designations,
                    "message" => $review->message
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('review.index')
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
        if(Request::hasFile('photo')){
            $path = Request::file('photo')->store('image', 'public');
        }
        $rev = Review::create([
            'name' => Request::input('name'),
            'photo' => $path ?? null,
            'designations' => Request::input('designations'),
            'message' => Request::input('message')
        ]);
        Gallery::create([
            'imageable_id' => $rev->id,
            'imageable_type' => 'App\\Models\\Review',
            'filename' => $path
        ]);

        return Redirect::route('review.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  Review::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return  Redirect::route('review.index');
    }
}
