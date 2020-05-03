<?php


namespace App\Http\Controllers;


use App\Models\Tankolas;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelController
{
    public function index()
    {
        $auto_id = session('car_id',0);
        $minkm= Tankolas::where('auto_Azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return view('fuel.index', compact('minkm'));
    }

    public function postfuel(Request $request){
        $auto_id = session('car_id',0);
        $fuel = New Tankolas();
        $fuel->user_id = Auth::id();
        $fuel->auto_azonosito = $auto_id;
        $fuel->km_ora = $request->post('km_ora');
        $fuel->liter = $request->post('liter');
        $fuel->osszeg = $request->post('ar');
        $fuel->save();
        $minkm= Tankolas::where('auto_Azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return view('fuel.index', compact('minkm'));
    }
}
