<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Admin;
use App\User;

class AdminController extends Controller
{

	public function dashboard()
	{
        $active = 'dashboard';
		return view('admin.index', compact('active'));
	}

    public function getAllAdmins()
    {
    	$admins = User::where('type', '=', 'admin')->get();
    	$active = 'admins';
    	return view('admin.admin', compact('admins','active'));
    }
    
    public function getcompany()
    {
    	$companies = User::where('type', '=', 'company')->get();
    	$active    = 'companies';
    	return view('admin.company', compact('companies', 'active'));
    }

    public function getAllJobSeeker()
    {
        $jobseekers = User::where('type', '=', 'jobseeker')->get();
        $active     = 'jobseekers';
        return view('admin.jobseeker',compact('jobseekers', 'active'));
    }

    public function getExaminers()
    {
        $examiners = User::where('type', '=', 'examiner')->get();
        $active = 'examiners';
        return view('admin.examiners', compact('active', 'examiners'));
    }

    public function addNewUser(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'password'  => 'required|string|max:255',
            'type'      => 'required'
        ]);

        $examiner           = new User;
        $examiner->name     = $request->name;
        $examiner->email    = $request->email;
        $examiner->password = bcrypt($request->password);
        $examiner->type     = $request->type;
        $examiner->save();

        if($examiner->save()) {
            return response()->json(['success' => true, 'url' => $request->type.'s']);
        }
    }

    public function editUser(Request $id)
    {
        $admin = User::find($id);
        return response()->json($admin, 200);
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email'  => 'required|string|max:255',
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        if($user->save()) {
            return response()->json(['success' => true, 'url' => $user->type.'s']);
        } 
    }

    public function deleteUser(Request $id)
    {
        User::find($id)->delete();
    }

    public function getSettings()
    {
        $active = 'settings';
        $settings = Setting::find(1);
        return view('admin.settings', compact('active', 'settings'));
    }

    public function postSettingsPaypal(Request $request)
    {
        $check_query = Setting::find(1);
        
        if (!$check_query) {
            $check_query = new Setting;
        }
        
        $check_query->paypal_mode = $request->paypal_mode;
        $check_query->client_id   = $request->client_id;
        $check_query->secret_id   = $request->secret_id;
        $check_query->save();
    }

    public function postSettingsQuestions(Request $request)
    {
        $check_query = Setting::find(1);

        if (!$check_query) {
            $check_query = new Setting;
        }

        $check_query->num_of_questions   = $request->num_of_question;
        $check_query->time_for_questions = $request->time_for_exam;
        $check_query->save();   
    }
}