<?php

namespace App\Http\Controllers;

use App\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class pagesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Carbon::setLocale('fa');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function banners()
    {
        $banners = Banner::with('photos')->where(['status' => 1])->orderBy('created_at', 'DESC')->get();
        return response()->json($banners, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }
}
