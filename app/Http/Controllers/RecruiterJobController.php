<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use App\Models\Job;
use App\Models\MessageDetail;
use App\Models\SaveJob;
use App\Models\SubCategory;
use App\Models\User;
use App\Properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;


class RecruiterJobController extends Controller
{
    public function allRecruiters(){

        return inertia('Backend/Recruiter/Index', [
            $search = Request::input('search'),
            'recruiters' => User::query()
                ->with('recruiter')
                ->where('role', Properties::$recruiter)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('email', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($recruiter) => [
                    'id' => $recruiter->id,
                    'name' => $recruiter->name,
                    'phone' => $recruiter->phone,
                    'photo' => $recruiter->photo,
                    'email' => $recruiter->email,
                    'address' => $recruiter->address,
                    'note' => $recruiter->note,
                    'v_status' => $recruiter->is_verified,
                    'a_status' => $recruiter->is_active,
                    'recruiter'=> $recruiter->recruiter,
                    'created_at' => $recruiter->created_at->format('d,M-Y'),
                    'show_rec' => URL::route('singleRecruiters', $recruiter->id)
                ]),
            'filters' => Request::only(['search', 'perPage']),
        ]);
    }

    public function singleRecruiters($id)
    {
        $user = User::findOrFail($id)->load('recruiter');

        $jobs = Job::where('creator', $id)->latest()->withCount('messageDetails')->get();
        $totalChats = MessageDetail::where('recruiter_id', Auth::id())->count('seeker_id');
        $saveJobs = SaveJob::where('user_id', Auth::id())->count();


        return inertia("Backend/Recruiter/Show", [
            'recruiter' => $user,
            'chat_jobs' => $totalChats,
            't_jobs' => $jobs->count(),
            'save_jobs' => $saveJobs
        ]);
    }


    public function changeAStatus($id, $status){
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => $status == 'true' ? 1 : 0
        ]);
        return back();
    }


    public function changeStatus(){
        $user = User::findOrFail(Request::input('rec_id'))->load('recruiter');

        $user->recruiter->update([
            'status' => Request::input('status')
        ]);

        return back();
    }


}
