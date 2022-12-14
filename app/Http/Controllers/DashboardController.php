<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Job;
use App\Models\MessageDetail;
use App\Models\MessageInfo;
use App\Models\SaveJob;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use mysql_xdevapi\Exception;
use Opcodes\LogViewer\Facades\LogViewer;

class DashboardController extends Controller
{
    public function admin()
    {
        try {
            $total_sale =  Cache::remember('total_sale', now()->addDay(), function (){
                return Transaction::count();
            });

            $total_student = Cache::remember('total_student', now()->addDay(), function () {
                return User::where('role', 'student')->count();
            });

            return inertia('Backend/Dash',[
                'total_sale' => $total_sale,
                'total_student' => $total_student
            ]);
        }catch (\Exception $exception){
            Log::alert('DashboardController admin', ['message' => $exception->getMessage()]);
            abort(500, $exception->getMessage());
        }

    }

    public function student()
    {
        return inertia('Backend/Student/Dashboard', [
            'report' =>[
                'total_wishlist_course' => Auth::user()->witchLists->count(),
                'total_transactions'    => Auth::user()->transactions->count(),
                'total_courses'         => Auth::user()->orders->count(),
                'total_subscriptions'   => Auth::user()->subscriptions->count(),
            ]
        ]);
    }

    public function recruiters()
    {
        $jobs = Job::where('creator', Auth::id())->latest()->withCount('messageDetails')->get();
        $totalChats = MessageDetail::where('recruiter_id', Auth::id())->count('seeker_id');
        $saveJobs = SaveJob::where('user_id', Auth::id())->count();
        return view('recruiters.dashboard', compact('jobs', 'totalChats', 'saveJobs'));
    }
}
