<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClientReview;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class ClientReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Backend/Category', [
            'categories' => ClientReview::query()->with("photos")
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($category) => [
                    'id'    => $category->id,
                    'name'  => $category->name,
                    'slug'  => $category->slug,
                    'pic' => $category,
                    'photo' => global_asset($category->photos->count() > 0 ? $category->photos[0]->filename : null)
                ]),
            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('categories.index')
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientReview  $clientReview
     * @return \Illuminate\Http\Response
     */
    public function show(ClientReview $clientReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientReview  $clientReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientReview $clientReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientReview  $clientReview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientReview $clientReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientReview  $clientReview
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientReview $clientReview)
    {
        //
    }
}
