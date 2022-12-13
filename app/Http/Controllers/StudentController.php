<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Admin/User/Student', [
            'students' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'photo' => $user->photo,
                    'active_on' => $user->created_at->format('d M Y'),
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('students.index')
            // 'can' => [
            //     'createUser' => Auth::user()->can('create', User::class)
            // ]
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
//        return User::findOrFail($id);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function purchase_history()
    {
        return inertia('Student/Purchase', [
            'orders' => Order::query()
                ->where('user_id', Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($order) => [
                    'id' => $order->id,
                    'course' => $order->course->name,
                    'photo' => $order->course->cover,
                    'payment_method' => $order->payment_method,
                    'pay_amount' => $order->pay_amount,
                    'pay_amount' => $order->pay_amount,
                    'currency' => $order->currency,
                    'created' => $order->created_at->format('d m Y'),
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('purchase_history')
        ]);
    }

    public function course_list()
    {
        return inertia('Student/Course', [
            'orders' => Order::query()
                ->where('user_id', Auth::user()->id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($order) => [
                    'id' => $order->id,
                    'course' => $order->course->name,
                    'course_slug' => $order->course->slug,
                    'photo' => $order->course->cover,
                    'payment_method' => $order->payment_method,
                    'pay_amount' => $order->pay_amount,
                    'pay_amount' => $order->pay_amount,
                    'currency' => $order->currency,
                    'created' => $order->created_at->format('d m Y'),
                ]),

            'filters' => Request::only(['search','perPage']),
            'url' => URL::route('course_list')
        ]);
    }

    public function course_details(Course $course, $slug)
    {
        $course = Course::where('slug', $slug)->first();

        return inertia('Student/CourseDetails', [
            'course' => Course::where('slug', $slug)->select('name', 'slug', 'description', 'content', 'cover', 'video', 'price', 'user_id', 'category_id', 'active_on', 'status')->first(),
            'lessons' => Lesson::where('course_id', $course->id)->get(),

            'url' => URL::route('course_list')
        ]);
    }

    public function student_profile()
    {
        return inertia('Student/Profile', [
            'user' => Auth::user(),
        ]);
    }
    public function student_profile_update()
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->phone = Request::input('phone');
        $user->gender = Request::input('gender');
        $user->married_status = Request::input('married_status');
        $user->about = Request::input('about');
        $user->dob = Request::input('dob');

        if (Request::hasFile('photo')) {
            $user->photo = Request::file('photo')->store('image', 'public');
        }

        $user->save();

        return Redirect::back();
    }
}
