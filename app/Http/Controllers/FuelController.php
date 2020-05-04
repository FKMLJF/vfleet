<?php


namespace App\Http\Controllers;


use App\Models\Futasteljesitmeny;
use App\Models\Tankolas;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelController
{
    public function index()
    {
        $auto_id = session('car_id',0);
        $minkm= Futasteljesitmeny::where('auto_azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return view('fuel.index', compact('minkm'));
    }

    public function postfuel(Request $request){
        $validator = \Validator::make($request->all(), [
            'km_ora' => 'required|numeric',
            'liter' => 'required|numeric',
            'ar' => 'required|numeric',
        ]);
        $auto_id = session('car_id',0);

        $validator->after(function($validator) use($request, $auto_id) {
            $minkm= Futasteljesitmeny::where('auto_azonosito', $auto_id)->max('km_ora');
            if(floatval($request->post('km_ora')) < floatval($minkm))
            {
                $validator->errors()->add('km_ora', 'Nem lehet kisebb mint az elöző kmóra állás!');
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->messages(), 418);
        }

        $fuel = New Tankolas();
        $fuel->user_id = Auth::id();
        $fuel->auto_azonosito = $auto_id;
        $fuel->km_ora = $request->post('km_ora');
        $fuel->liter = $request->post('liter');
        $fuel->osszeg = $request->post('ar');
        $fuel->save();
        $minkm= Futasteljesitmeny::where('auto_Azonosito', $auto_id)->max('km_ora');//DB::select ("Select max(km_ora) as maxkmora from tankolas where auto_azonosito=?", ['auto_azonosito' => $auto_id]);
        return json_encode(['km' => $minkm]);
    }
}
