<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeekerJobController extends Controller
{
    public function allSaveJobs(){
        return view('seekers.jobs.save_jobs');
    }
}
