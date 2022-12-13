<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Vimeo\Laravel\Facades\Vimeo;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Course/List', [
            'courses' => Course::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($course) => [
                    'id' => $course->id,
                    'name' => $course->name,
                    'description' => $course->description,
                    'cover' => $course->cover,
                    'video' => $course->video,
                    'status' => $course->status,
                    'price' => $course->price,
                    'active_on' => $course->active_on->format('d M Y'),
                    'category' => $course->category->name,
                    'instructor' => $course->user->name,
                    'show_url' => URL::route('courses.show', $course->id),
                    'edit_url' => URL::route('courses.edit', $course->id),
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('courses.index')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function create()
    {
        return inertia('Course/Create', [

            'categories' => Category::select('id', 'name')->get(),
            'url' => URL::route('courses.index')
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

        $image_path = '';
        $files_path = '';

        if (Request::hasFile('cover')) {
            $image_path = Request::file('cover')->store('image', 'public');
        }
        if (Request::hasFile('files')) {
            $files_path = Request::file('files')->store('image', 'public');
        }

        $course = new Course();

        $course->name = Request::input('name');
        $course->description = Request::input('description');
        $course->content = Request::input('content');
        $course->cover = $image_path;
        $course->files = $files_path;
        $course->price = Request::input('price');
        $course->user_id = Auth::user()->id;
        $course->category_id = Request::input('category_id');
        $course->active_on = date("Y-m-d", strtotime(Request::input('active_on')));
        $course->save();

        $vimeo_url = '';
        if (Request::hasFile('video')) {
            $vimeo_url = Vimeo::upload(Request::file('video'), [
                'name' => Request::input('name'),
                'description' => Request::input('description')
            ]);

            $course->video = $vimeo_url;
            $course->save();
        }

        return Redirect::route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return inertia('Course/Show', [
            'course' => Course::findOrFail($course->id),
            'lessons' => Lesson::where('course_id', $course->id)->select('id', 'name', 'status')->get(),
            'url' => URL::route('courses.index'),
            'lesson_store_url' => URL::route('lessons.store'),
            // 'lesson_update_url' => URL::route('lessons.update'),
            // 'can' => [
            //     'createUser' => Auth::user()->can('create', User::class)
            // ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back();
    }

    public function courseLessonStore()
    {
        # code...
    }

    public function courseLessonUpadate()
    {
        # code...
    }
}
