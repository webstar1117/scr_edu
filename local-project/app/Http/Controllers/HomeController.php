<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Player;
use App\Models\SiteChat;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }
        if (view()->exists($request->path())) {
           dd('homeController');
        }
        return view('pages-404');
    }

    public function root()
    {

        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }

        $site_chat=SiteChat::all()[0];  
        return view('index', [
            'site_chat'=>$site_chat
        ]);
    }

}
