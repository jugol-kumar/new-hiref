<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Vimeo\Laravel\Facades\Vimeo;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store()
    {
        $lesson = Lesson::create(
            Request::validate([
                'name' => 'required|max:150',
                'description' => 'required',
                'video' => 'required',
                'course_id' => 'required',
                'status' => 'boolean',
            ])
        );

        $vimeo_url = '';
        if (Request::hasFile('video')) {
            $vimeo_url = Vimeo::upload(Request::file('video'), [
                'name' => Request::input('name'),
                'description' => Request::input('description')
            ]);

            $lesson->video = $vimeo_url;
            $lesson->save();
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
