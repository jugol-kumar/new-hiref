<?php

namespace App\Http\Controllers;

use App\Models\ChildCategory;
use App\Models\MessageDetail;
use App\Models\SaveJob;
use App\Models\SubCategory;
use App\Models\User;
use App\Properties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SeekerJobController extends Controller
{
    public function allSaveJobs(){
        $jobs = SaveJob::where('user_id', Auth::id())
            ->latest()
            ->with(['job','job.category', 'job.companyDetails.photos'])
            ->paginate(10);
        $save = true;
        return view('seekers.jobs.save_jobs', compact('jobs', 'save'));
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
        $chatingJobs = MessageDetail::where('seeker_id', $id)->count();
        $user        = User::findOrFail($id)->load(['seeker', 'seeker.division', 'seeker.district', 'seeker.educaiton', 'seeker.category', 'seeker.education_level', 'seeker.category']);

        $data = json_decode($user->seeker->subcategories);

        $subCat = [];
        $cCat = [];
        foreach ($data as $datum) {
            $cat = explode(',', $datum);
            $subCat[] = $cat[0];
            $cCat[] = $cat[1];
        }
        $subCats = SubCategory::whereIn('id', array_unique($subCat))->get();
        $cCats = ChildCategory::whereIn('id', array_unique($cCat))->get();

         return inertia("Backend/Seekers/Show", [
             'seeker' => $user,
             'chat_jobs' => $chatingJobs,
             'subCats' => $subCats,
             'cCat' => $cCats,
             'resume' => Storage::url($user->seeker->resume),
             'skills' => json_decode(json_decode($user->seeker->skills))
         ]);
    }

    public function deleteSeeker($id){
        return $id;
    }



}
