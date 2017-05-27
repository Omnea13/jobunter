<?php

namespace App\Http\Controllers;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Company;
use App\User;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function register(RegisterRequest $request)
    {
        $user           = new User;
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->type     = $request['type'];
        $user->password = bcrypt($request['password']);
        
        if($user->save()) {
            
            Auth::guard()->login($user);

            if ($user->type == 'jobseeker') {
                return response()->json(['success' => true, 'url' => 'jobseeker']);
            } elseif ($user->type == 'company') {
                
                $company = new Company;
                $company->user_id     = $user->id;
                // $company->type        = 'trail';
                $company->expire_date = strtotime(Carbon::now()->addDays(15));
                $company->save();
                
                return response()->json(['success' => true, 'url' => 'company']);
            } else {
                return response()->json(['success' => true, 'url' => '/']);
            }

        }
    }

    public function login(LoginRequest $request)
    {
        
        if ($request->remember) {
            $remember = true;
        } else {
            $remember = false;
        }

        $loginData = [
            'email'    => $request->email,
            'password' => $request->password
        ]; 

        if(Auth::attempt($loginData, $remember)) {
                        
            if (Auth::user()->type == 'jobseeker') {
                $url = 'jobseeker';
            } elseif (Auth::user()->type == 'company') {
                $url = 'company';
            } elseif (Auth::user()->type == 'admin') {
                $url = 'admin';
            } elseif (Auth::user()->type == 'examiner') {
                $url = 'examiner';
            } else {
                $url = '/';
            }

            return response()->json(['success' => true, 'url' => $url], 200);
        
        } else {
            return response()->json(['error' => ['Invalid email or password. Please try again.']], 402);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getLogin()
    {
        return view('login');
    }
}