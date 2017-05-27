<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Job;
use Helper;
use Auth;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getNewJob()
    {
        return view('company.jobs.add');
    }

    public function postNewJob(Request $request)
    {
        $postedJob               = new Job;
        $postedJob->user_id      = Auth::id();
        $postedJob->name         = $request->title;
        $postedJob->description  = $request->description;
        $postedJob->requirements = $request->requirements;
        $postedJob->skills       = $request->skills;
        $postedJob->salary       = $request->salary;
        $postedJob->location     = $request->location;
        $postedJob->expire_date  = Carbon::parse($request->end_date)->format('Y-m-d H:m:s');
        $postedJob->save();
        
        return response()->json(['success' => true]);
    }

    public function jobDetails(Request $request)
    {
        $job    = Job::where('id', '=', $request->id)->where('user_id', '=', Auth::id())->first();
        $skills = explode(",", $job->skills);

        return view('company.jobs.details', compact('job', 'skills'));
    }

    public function getEditJob($id)
    {
        $job  = Job::find($id);

        return view('company.jobs.edit', compact('job'));
    }

    public function postEditJob(Request $request)
    {
        if ($request->id) {
            $id = $request->id;

            $editJob = Job::find($id);
            $editJob->name         = $request->title;
            $editJob->description  = $request->description;
            $editJob->requirements = $request->requirements;
            $editJob->skills       = $request->skills;
            $editJob->salary       = $request->salary;
            $editJob->type         = $request->type;
            $editJob->location     = $request->location;
            $editJob->expire_date  = Carbon::parse($request->end_date)->format('Y-m-d H:m:s');
            $editJob->save();

            return response()->json(['success' => true]);
        } else {
            return redirect('dashboard');
        }
    }

    public function deleteJob(Request $request)
    {
        Job::find($request->id)->delete();
    }
}