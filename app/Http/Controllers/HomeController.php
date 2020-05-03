<?php

namespace App\Http\Controllers;

use App\Models\Autok;
use App\Models\Muszaki;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $muszaki = Muszaki::where('auto_azonosito', '=', session('car_id',0))->first();
        $car = Autok::where('azonosito',session('car_id', 0))->first();
        return view('home.index', compact('car', 'muszaki'));
    }

    public function profil()
    {
        $user = User::all()->where('id', '=', Auth::id())->first();
        return view('home.profil', compact("user"));
    }

}
