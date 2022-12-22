<?php

namespace App\Http\Controllers;

use App\Models\MessageDetail;
use App\Models\User;
use App\Properties;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class SeekerJobController extends Controller
{
    public function allSaveJobs(){
        return view('seekers.jobs.save_jobs');
    }


    public function allSeekers()
    {
        return inertia('Backend/Seekers/Index', [
            $search = Request::input('search'),
            'seekers' => User::query()
                ->with(['seeker', 'seeker.division', 'seeker.district'])
                ->where('role', Properties::$seeker)
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('email', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('address', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                })
                ->paginate(Request::input('perPage') ?? 10)
                ->withQueryString()
                ->through(fn($seeker) => [
                    'id' => $seeker->id,
                    'name' => $seeker->name,
                    'phone' => $seeker->phone,
                    'photo' => $seeker->photo,
                    'email' => $seeker->email,
                    'address' => $seeker->address,
                    'note' => $seeker->note,
                    'v_status' => $seeker->is_verified,
                    'a_status' => $seeker->is_active,
                    'seeker'=> $seeker->seeker,
                    'created_at' => $seeker->created_at->format('d,M-Y'),
                    'show_url' => URL::route('singleSeeker', $seeker->id),
                    'delete_url' => URL::route('deleteSeeker', $seeker->id),
                ]),
            'filters' => Request::only(['search', 'perPage']),
        ]);

    }

    public function singleSeeker($id){
//        return  User::findOrFail($id)->load(['seeker', 'seeker.division', 'seeker.district', 'seeker.educaiton', 'seeker.category', 'seeker.education_level']);

        $chatingJobs = MessageDetail::where('seeker_id', $id)->count();

         return inertia("Backend/Seekers/Show", [
             'seeker' => User::findOrFail($id)->load(['seeker', 'seeker.division', 'seeker.district', 'seeker.educaiton', 'seeker.category', 'seeker.education_level']),
             'chat_jobs' => $chatingJobs,
         ]);
    }

    public function deleteSeeker($id){
        return $id;
    }



}
