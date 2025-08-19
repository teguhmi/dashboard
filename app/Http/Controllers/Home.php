<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('roleadmin:admin')->except('index','refreshCaptcha');
    }
    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);

    }
    public function index(Request $request)
    {
        return view('pages.dashboardhome');
    }

    public function user_data()
    {
        $datauser = User::getUser();
        return view('auth.data_user',compact('datauser'));
    }
    public function crop()
    {
        return view('test_crop');
    }
}
