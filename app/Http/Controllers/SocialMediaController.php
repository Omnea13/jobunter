<?php

namespace App\Http\Controllers;

use App\SocialMedia;
use Auth;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{

    public function index()
    {

        return view('company.index');
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $check = SocialMedia::Where('user_id','=',10)->first();

        if($check)
        {
            $socialMedia = $check;
        } else {

            $socialMedia = new SocialMedia;

            $socialMedia->user_id = 10;
        }
        $socialMedia->website     = $request['website'];

        $socialMedia->facebook = $request['facebook'];
        $socialMedia->twitter  = $request['twitter'];
        $socialMedia->linkedin = $request['linkedin'];

        $socialMedia->save();

        return response()->json(['success' => true, 'url' => 'index']);


    }

    public function show($id)
    {
        $socialMedia = SocialMedia::find($id);

        return view('company.index');
    }
}
