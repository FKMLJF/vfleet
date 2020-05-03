<?php

namespace App\Http\Controllers;

use App\Models\Autok;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function index()
    {
        $car = Autok::where('azonosito',session('car_id', 0))->first();
        return view('home.index', compact('car'));
    }

    public function profil()
    {
        return view('home.profil');
    }

}
